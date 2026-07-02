<?php

namespace App\Http\Controllers;

use App\Models\DesignProposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    /**
     * Show public portal (Guest Form & Tracking)
     */
    public function index()
    {
        return view('portal');
    }

    /**
     * Handle login authentication
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validated['username'] === 'admin' && $validated['password'] === 'admin') {
            session(['admin_logged_in' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username atau password salah.'
        ], 401);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        session()->forget('admin_logged_in');
        return redirect()->route('portal');
    }

    /**
     * Show Admin Dashboard (Protected)
     */
    public function adminIndex()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('portal', ['login' => 1]);
        }

        $proposals = DesignProposal::orderBy('created_at', 'desc')->get();
        return view('admin', compact('proposals'));
    }

    /**
     * Get all proposals (API list endpoint)
     */
    public function listAll()
    {
        $proposals = DesignProposal::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $proposals
        ]);
    }

    /**
     * Store new proposal (both Web Form and API support)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_country_code' => 'required|string|max:10',
            'phone_number' => 'required|string|min:8|max:15',
            'address_street' => 'required|string|max:255',
            'address_street2' => 'nullable|string|max:255',
            'address_city' => 'required|string|max:100',
            'address_province' => 'required|string|max:100',
            'address_postal' => 'required|string|size:5',
            'project_description' => 'nullable|string',
        ]);

        // Generate proposal code (Format: WD-YYYYMM-XXX)
        $yearMonth = date('Ym');
        $random = rand(100, 999);
        $proposalCode = "WD-{$yearMonth}-{$random}";

        // Ensure unique
        while (DesignProposal::where('proposal_code', $proposalCode)->exists()) {
            $random = rand(100, 999);
            $proposalCode = "WD-{$yearMonth}-{$random}";
        }

        $proposal = DesignProposal::create(array_merge($validated, [
            'proposal_code' => $proposalCode,
            'status' => 'Pending'
        ]));

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Proposal berhasil dibuat.',
                'data' => $proposal
            ], 201);
        }

        return redirect()->route('portal')->with([
            'success_code' => $proposalCode,
            'client_name' => $proposal->client_name
        ]);
    }

    /**
     * Track proposal by code (API endpoint)
     */
    public function track($code)
    {
        $proposal = DesignProposal::where('proposal_code', $code)->first();

        if (!$proposal) {
            return response()->json([
                'success' => false,
                'message' => 'Kode penawaran tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $proposal
        ]);
    }

    /**
     * Update proposal status (Admin action)
     */
    public function updateStatus(Request $request, $code)
    {
        $proposal = DesignProposal::where('proposal_code', $code)->first();

        if (!$proposal) {
            return response()->json([
                'success' => false,
                'message' => 'Proposal tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'status' => 'required|in:Pending,Reviewed,Approved,Rejected'
        ]);

        $proposal->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Status proposal berhasil diperbarui.',
            'data' => $proposal
        ]);
    }

    /**
     * Delete proposal (Admin action)
     */
    public function destroy($code)
    {
        $proposal = DesignProposal::where('proposal_code', $code)->first();

        if (!$proposal) {
            return response()->json([
                'success' => false,
                'message' => 'Proposal tidak ditemukan.'
            ], 404);
        }

        $proposal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Proposal berhasil dihapus.'
        ]);
    }
}
