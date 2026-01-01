<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FeedbackController extends Controller
{
    // Show feedback form
    public function index()
    {
        // Public feedback form - no login required
        return view('feedback');
    }

    // Store feedback submission
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'nullable|string|max:255',
            'mobile' => 'required|string|regex:/^[0-9]{10}$/|size:10',
            'overall_experience' => 'required|string',
            'cleanliness' => 'required|string',
            'room_condition' => 'required|string',
            'bathroom_cleanliness' => 'required|string',
            'staff_behaviour' => 'required|string',
            'basic_facilities' => 'required|string',
            'money_return' => 'required|string',
            'stay_again' => 'required|string',
            'recommend' => 'required|string',
            'suggestions' => 'nullable|string',
        ], [
            'mobile.regex' => 'Mobile number must be exactly 10 digits. / मोबाइल नंबर ठीक 10 अंकों का होना चाहिए।',
            'mobile.size' => 'Mobile number must be exactly 10 digits. / मोबाइल नंबर ठीक 10 अंकों का होना चाहिए।',
        ]);

        // Insert feedback using Query Builder
        DB::table('feedbacks')->insert([
            'name' => $request->name ?? null,
            'mobile' => $request->mobile,
            'overall_experience' => $request->overall_experience,
            'cleanliness' => $request->cleanliness,
            'room_condition' => $request->room_condition,
            'bathroom_cleanliness' => $request->bathroom_cleanliness,
            'staff_behaviour' => $request->staff_behaviour,
            'basic_facilities' => $request->basic_facilities,
            'money_return' => $request->money_return,
            'stay_again' => $request->stay_again,
            'recommend' => $request->recommend,
            'suggestions' => $request->suggestions,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Feedback submitted successfully'
            ]);
        }

        // Regular form submission - redirect without query parameters
        return redirect()->to('/')->with('success', 'true');
    }

    // Show feedback list (Admin Panel)
    public function list(Request $request)
    {
        // Get total count (all feedbacks)
        $totalCount = DB::table('feedbacks')->count();
        
        // Get week count (last 7 days)
        $weekCount = DB::table('feedbacks')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();
        
        // Get month count (last 30 days)
        $monthCount = DB::table('feedbacks')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        
        // Start query builder for main results
        $query = DB::table('feedbacks');
        
        // Search functionality
        $searchCount = 0;
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('mobile', 'like', '%' . $search . '%')
                  ->orWhere('suggestions', 'like', '%' . $search . '%');
            });
            
            // Get search count
            $searchQuery = DB::table('feedbacks');
            $searchQuery->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('mobile', 'like', '%' . $search . '%')
                  ->orWhere('suggestions', 'like', '%' . $search . '%');
            });
            $searchCount = $searchQuery->count();
        }
        
        // Filter by week (last 7 days)
        if ($request->has('filter') && $request->filter == 'week') {
            $query->where('created_at', '>=', now()->subDays(7));
        }
        
        // Filter by month (last 30 days)
        if ($request->has('filter') && $request->filter == 'month') {
            $query->where('created_at', '>=', now()->subDays(30));
        }
        
        // Get current filtered count (before pagination)
        $currentCount = $query->count();
        
        // Order by created date
        $query->orderBy('created_at', 'desc');
        
        // Paginate results (15 per page)
        $feedbacks = $query->paginate(15);
        
        // Append query parameters to pagination links
        $feedbacks->appends($request->query());
        
        return view('admin', compact('feedbacks', 'totalCount', 'weekCount', 'monthCount', 'searchCount', 'currentCount'));
    }

    // Show single feedback details
    public function show($id)
    {
        // Get single feedback using Query Builder
        $feedback = DB::table('feedbacks')
            ->where('id', $id)
            ->first();

        // Check if feedback exists
        if (!$feedback) {
            return redirect()->route('admin.list')->with('error', 'Feedback not found.');
        }

        return view('feedback-view', compact('feedback'));
    }

    // Show reports with statistics
    public function report(Request $request)
    {
        // Helper function to get base query with date filters
        $getBaseQuery = function() use ($request) {
            $query = DB::table('feedbacks');
            
            // Apply date filter if provided
            if ($request->has('date_from') && $request->date_from) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            
            if ($request->has('date_to') && $request->date_to) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }
            
            return $query;
        };

        // Get total feedback count with filter
        $totalFeedbacks = $getBaseQuery()->count();

        // Overall Experience Statistics
        $overallExperience = $getBaseQuery()
            ->select('overall_experience', DB::raw('count(*) as count'))
            ->groupBy('overall_experience')
            ->get();

        // Cleanliness Statistics
        $cleanliness = $getBaseQuery()
            ->select('cleanliness', DB::raw('count(*) as count'))
            ->groupBy('cleanliness')
            ->get();

        // Room Condition Statistics
        $roomCondition = $getBaseQuery()
            ->select('room_condition', DB::raw('count(*) as count'))
            ->groupBy('room_condition')
            ->get();

        // Bathroom Cleanliness Statistics
        $bathroomCleanliness = $getBaseQuery()
            ->select('bathroom_cleanliness', DB::raw('count(*) as count'))
            ->groupBy('bathroom_cleanliness')
            ->get();

        // Staff Behaviour Statistics
        $staffBehaviour = $getBaseQuery()
            ->select('staff_behaviour', DB::raw('count(*) as count'))
            ->groupBy('staff_behaviour')
            ->get();

        // Basic Facilities Statistics
        $basicFacilities = $getBaseQuery()
            ->select('basic_facilities', DB::raw('count(*) as count'))
            ->groupBy('basic_facilities')
            ->get();

        // Money Return Statistics
        $moneyReturn = $getBaseQuery()
            ->select('money_return', DB::raw('count(*) as count'))
            ->groupBy('money_return')
            ->get();

        // Stay Again Statistics
        $stayAgain = $getBaseQuery()
            ->select('stay_again', DB::raw('count(*) as count'))
            ->groupBy('stay_again')
            ->get();

        // Recommend Statistics
        $recommend = $getBaseQuery()
            ->select('recommend', DB::raw('count(*) as count'))
            ->groupBy('recommend')
            ->get();

        return view('report', compact(
            'totalFeedbacks',
            'overallExperience',
            'cleanliness',
            'roomCondition',
            'bathroomCleanliness',
            'staffBehaviour',
            'basicFacilities',
            'moneyReturn',
            'stayAgain',
            'recommend'
        ));
    }
}
