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
        // Check if user is logged in
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Please login to submit feedback.');
        }
        
        return view('feedback');
    }

    // Store feedback submission
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'nullable|string|max:255',
            'mobile' => 'required|string|max:20',
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
    public function report()
    {
        // Get total feedback count
        $totalFeedbacks = DB::table('feedbacks')->count();

        // Overall Experience Statistics
        $overallExperience = DB::table('feedbacks')
            ->select('overall_experience', DB::raw('count(*) as count'))
            ->groupBy('overall_experience')
            ->get();

        // Cleanliness Statistics
        $cleanliness = DB::table('feedbacks')
            ->select('cleanliness', DB::raw('count(*) as count'))
            ->groupBy('cleanliness')
            ->get();

        // Room Condition Statistics
        $roomCondition = DB::table('feedbacks')
            ->select('room_condition', DB::raw('count(*) as count'))
            ->groupBy('room_condition')
            ->get();

        // Bathroom Cleanliness Statistics
        $bathroomCleanliness = DB::table('feedbacks')
            ->select('bathroom_cleanliness', DB::raw('count(*) as count'))
            ->groupBy('bathroom_cleanliness')
            ->get();

        // Staff Behaviour Statistics
        $staffBehaviour = DB::table('feedbacks')
            ->select('staff_behaviour', DB::raw('count(*) as count'))
            ->groupBy('staff_behaviour')
            ->get();

        // Basic Facilities Statistics
        $basicFacilities = DB::table('feedbacks')
            ->select('basic_facilities', DB::raw('count(*) as count'))
            ->groupBy('basic_facilities')
            ->get();

        // Money Return Statistics
        $moneyReturn = DB::table('feedbacks')
            ->select('money_return', DB::raw('count(*) as count'))
            ->groupBy('money_return')
            ->get();

        // Stay Again Statistics
        $stayAgain = DB::table('feedbacks')
            ->select('stay_again', DB::raw('count(*) as count'))
            ->groupBy('stay_again')
            ->get();

        // Recommend Statistics
        $recommend = DB::table('feedbacks')
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
