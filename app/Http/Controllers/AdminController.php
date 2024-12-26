<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Course;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use App\Models\Lesson;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalCourses = Course::count();
        $totalLessons = Lesson::count();
        $totalPayments = Payment::sum('amount');

        $selectedYear = request()->get('year', date('Y'));
        $userRegistrations = $this->getMonthlyRegistrations($selectedYear);
        $paymentData = $this->getMonthlyPayments($selectedYear);

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalCategories' => $totalCategories,
            'totalPayments' => $totalPayments,
            'totalCourses' => $totalCourses,
            'totalLessons' => $totalLessons,
            'chartLabels' => $userRegistrations['labels'],
            'chartData' => $userRegistrations['data'],
            'paymentLabels' => $paymentData['labels'],
            'paymentAmounts' => $paymentData['amounts'],
            'selectedYear' => $selectedYear,
        ]);
    }

    private function getMonthlyRegistrations($year)
    {
        $registrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $registrations->pluck('month')->map(fn($month) => Carbon::createFromFormat('!m', $month)->format('F'))->toArray();
        $data = $registrations->pluck('count')->toArray();

        return compact('labels', 'data');
    }

    private function getMonthlyPayments($year)
    {
        $payments = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $payments->pluck('month')->map(fn($month) => Carbon::createFromFormat('!m', $month)->format('F'))->toArray();
        $amounts = $payments->pluck('total')->toArray();

        return compact('labels', 'amounts');
    }

    public function manageUsers(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }
    public function editUser($id)
    {
        $user2 = User::findOrFail($id);
        return view('admin.users.edit', compact('user2'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $user = User::findOrFail($id);
        $user->update($request->only('name'));

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function destroyUser($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function toggleBan($id)
    {
        $user = User::findOrFail($id)->instructor;

        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'active' : 'banned';
        return redirect()->back()->with('success', "User has been {$status} successfully.");
    }
    public function manageCategories(Request $request)
    {
        $search = $request->input('search');

        $categories2 = Category::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('id', '=',  $search);
            })
            ->paginate(10);

        return view('admin.categories.index', compact('categories2'));
    }


    public function createCategory()
    {
        return view('admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255', 'parent_id' => 'nullable|integer']);
        Category::create($request->all());

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255', 'parent_id' => 'nullable|integer']);
        $category = Category::findOrFail($id);
        $category->update($request->only('name', 'parent_id'));

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroyCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function managePayments()
    {
        $payments = Payment::paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    public function paymentAnalysis(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $payments = Payment::query()
            ->when($startDate, fn($query) => $query->where('created_at', '>=', $startDate))
            ->when($endDate, fn($query) => $query->where('created_at', '<=', $endDate))
            ->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }
    public function deletePaymentHistory()
    {
        Payment::truncate();
        return redirect()->route('admin.payment-analysis')->with('success', 'All payment history has been deleted.');
    }
    public function reports(Request $request)
    {
        $reportType = $request->get('report_type');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        [$data, $headers] = $this->generateReportData($reportType, $startDate, $endDate);
        return view('admin.reports.index', compact('data', 'headers', 'reportType'));
    }

    private function generateReportData($reportType, $startDate, $endDate)
    {
        $data = [];
        $headers = [];

        switch ($reportType) {
            case 'users':
                $data = User::when($startDate, fn($query) => $query->where('created_at', '>=', $startDate))
                    ->when($endDate, fn($query) => $query->where('created_at', '<=', $endDate))
                    ->get(['id', 'name', 'email', 'created_at'])->toArray();
                $headers = ['ID', 'Name', 'Email', 'Registration Date'];
                break;

            case 'courses':
                $data = Course::when($startDate, fn($query) => $query->where('created_at', '>=', $startDate))
                    ->when($endDate, fn($query) => $query->where('created_at', '<=', $endDate))
                    ->get(['id', 'title', 'price', 'created_at'])->toArray();
                $headers = ['ID', 'Course Name', 'Price',   'Creation Date'];
                break;

            case 'stats':
                $data = [
                    ['Description' => 'Total Users', 'Value' => User::count()],
                    ['Description' => 'Total Courses', 'Value' => Course::count()],
                    ['Description' => 'Total Payments', 'Value' => Payment::sum('amount')],
                ];
                $headers = ['Description', 'Value'];
                break;
        }

        return [$data, $headers];
    }

    public function exportExcel(Request $request)
    {
        $reportType = $request->get('type');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        return Excel::download(new ReportExport($reportType, $startDate, $endDate), 'report.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $reportType = $request->get('type');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        [$data, $headers] = $this->generateReportData($reportType, $startDate, $endDate);
        $pdf = Pdf::loadView('admin.reports.report-pdf', compact('data', 'headers', 'reportType', 'startDate', 'endDate'));
        return $pdf->download('report.pdf');
    }
    public function settingsPage()
    {
        $settingsPath = storage_path('app/settings.json');
        $settings = json_decode(file_get_contents($settingsPath), true);

        return view('admin.settings.index');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $settingsPath = storage_path('app/settings.json');
        $settings = json_decode(file_get_contents($settingsPath), true);

        $settings['site_name'] = $request->site_name;
        $settings['site_email'] = $request->site_email;

        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $destinationPath = public_path('logos');
            $fileName = time() . '_' . $file->getClientOriginalName();
            if ($settings['site_logo'] && $settings['site_logo'] !== 'default-logo.png') {
                $oldLogoPath = public_path('logos/' . $settings['site_logo']);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }
            $file->move($destinationPath, $fileName);
            $settings['site_logo'] = 'logos/' . $fileName;
        }

        file_put_contents($settingsPath, json_encode($settings, JSON_PRETTY_PRINT));

        return redirect()->route('admin.settings')->with('success', ' successfully updated settings');
    }
    public function profileEdit()
    {
        $admin = Auth::user();
        return view('admin.profile.index', compact('admin'));
    }
    public function profileUpdate(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_password' => 'required|string',
            'password' => 'nullable|string|min:8',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $filename);


            if ($admin->avatar !== 'default.png') {
                @unlink(public_path('avatars/' . $admin->avatar));
            }

            $admin->avatar = 'avatars/' . $filename;
        }

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->password) {
            $admin->password = $request->password;
        }

        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }
    public function notifications()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('admin.notifications.index', compact('notifications'));
    }
}
