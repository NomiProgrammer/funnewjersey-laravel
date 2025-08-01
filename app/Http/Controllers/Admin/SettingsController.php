<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
class SettingsController extends Controller
{
    //



public function showSettingsForm()
{
    $row = Settings::where('key', 'smtp_settings')->first();

    $settings = [];
    if ($row) {
        $settings = json_decode($row->values, true);
    }

    return view('dashboard.admin.system.smtp_settings', compact('settings'));
}

public function updateSmtpSettings(Request $request)
{
    $data = $request->only([
        'smtp_email',
        'smtp_host',
        'smtp_port',
        'smtp_timeout',
        'smtp_user',
        'smtp_pass',
        'char_set',
        'new_line',
        'mail_type',
    ]);

    Settings::updateOrCreate(
        ['key' => 'smtp_settings'],
        ['values' => json_encode($data)]
    );

    return redirect()->back()->with('success', 'SMTP settings updated successfully.');
}
      public function index()
    {
        $files = array_values(array_diff(scandir(public_path('assets/backups')), ['.', '..', 'index.html']));
        rsort($files); // Most recent first
        return view('dashboard.admin.system.backup', compact('files'));
    }

    public function createSqlBackup()
    {
        if (env('APP_ENV') === 'demo') {
            return back()->with('success', 'Disabled in demo mode.');
        }

        $file = 'db-backup-' . now()->format('Y-m-d_H-i-s') . '.sql';
        $path = public_path('assets/backups/' . $file);
        $command = "mysqldump -u " . env('DB_USERNAME') . " -p'" . env('DB_PASSWORD') . "' " . env('DB_DATABASE') . " > \"$path\"";
        exec($command);

        return back()->with('success', 'SQL Backup Created');
    }

public function createImageBackup()
{
    $zipFile = 'image-backup-' . now()->format('Y-m-d_H-i-s') . '.zip';
    $zipPath = public_path("assets/backups/{$zipFile}");
    $source = public_path('front_assets/uploads'); // ✅ correct path

    $zip = new \ZipArchive;
    if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
        foreach (File::allFiles($source) as $file) {
            $relativePath = str_replace($source . '/', '', $file->getPathname());
            $zip->addFile($file->getPathname(), $relativePath);
        }
        $zip->close();
    }

    return back()->with('success', 'Image Backup Created');
}

    public function download($index)
    {
        $files = array_values(array_diff(scandir(public_path('assets/backups')), ['.', '..', 'index.html']));
        if (!isset($files[$index])) abort(404);

        $filePath = public_path('assets/backups/' . $files[$index]);
        return response()->download($filePath);
    }

    public function delete($locale, $index)
    {
        if (env('APP_ENV') === 'demo') {
            return back()->with('success', 'Disabled in demo mode.');
        }

        $files = array_values(array_diff(scandir(public_path('assets/backups')), ['.', '..', 'index.html']));
        if (!isset($files[$index])) abort(404);

        unlink(public_path('assets/backups/' . $files[$index]));
        return back()->with('success', 'Backup deleted');
    }

    public function restore($index)
    {
        if (env('APP_ENV') === 'demo') {
            return back()->with('success', 'Disabled in demo mode.');
        }

        $files = array_values(array_diff(scandir(public_path('assets/backups')), ['.', '..', 'index.html']));
        if (!isset($files[$index])) abort(404);

        $filePath = public_path('assets/backups/' . $files[$index]);
        $command = "mysql -u " . env('DB_USERNAME') . " -p'" . env('DB_PASSWORD') . "' " . env('DB_DATABASE') . " < \"$filePath\"";
        exec($command);

        return back()->with('success', 'Database restored');
    }
public function settings()
{
    $row = Settings::where('key', 'webadmin_email')->first();

    $settings = [];
    if ($row) {
        $settings = json_decode($row->values, true);
    }

    $key = 'webadmin_email'; // Pass the key to the view for form submission

    return view('dashboard.admin.system.settings', compact('settings', 'key'));
}

public function saveSettings(Request $request)
{
     $key = 'webadmin_email'; // fixed key
    $request->validate([
        'contact_email'   => 'required|email',
        'webadmin_name'   => 'required|string|max:255',
        'webadmin_email'  => 'required|email',
    ]);
    $data = $request->only(['contact_email', 'webadmin_name', 'webadmin_email']);

    $setting = Settings::where('key', $key)->first();

    if ($setting) {
        // Update existing row
        $setting->values = json_encode($data);
        $setting->save();
    } else {
        // Create new row if not found
        Settings::create([
            'key'    => $key,
            'values' => json_encode($data),
        ]);
    }

    return back()->with('success', 'Settings updated successfully!');
}
public function sitemap(){
    return view('dashboard.admin.system.sitemap');

}
public function sitesettings()
{
    $setting = Settings::where('key', 'site_settings')->first();
    $values = json_decode($setting->values ?? '{}', true);
    return view('dashboard.admin.system.sitesettings', compact('values'));
}
public function saveSiteSettings(Request $request)
{
    $requestData = $request->except('_token');

    // Validation
    $request->validate([
        'site_title' => 'required|string|max:255',
        'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
    ]);

    // Handle file upload
    if ($request->hasFile('site_logo')) {
        $file = $request->file('site_logo');
        $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('front_assets/uploads/site');
        $file->move($destinationPath, $filename);

        $requestData['site_logo'] = $filename;
    } else {
        // Preserve old logo if no new file uploaded
        $existing = Settings::where('key', 'site_settings')->first();
        $existingValues = json_decode($existing->values ?? '{}', true);
        $requestData['site_logo'] = $existingValues['site_logo'] ?? null;
    }

    // Save JSON settings
    Settings::updateOrCreate(
        ['key' => 'site_settings'],
        ['values' => json_encode($requestData)]
    );

    return redirect()->back()->with('success', 'Site settings updated successfully.');
}

public function translate()
{
    $all_langs = config('business_directory.active_languages');
    return view('dashboard.admin.system.translate', compact('all_langs'));
}

public function translatelang(Request $request)
{
    set_time_limit(3600); // equivalent to ini_set('max_execution_time', 3600)

    $request->validate([
        'base_lang' => 'required',
        'target_lang_name' => 'required',
    ]);

    $baseLang = $request->input('base_lang');
    $targetLang = $request->input('target_lang_name');

    // Load the YAML file
    $filePath = base_path('dbc_config/locals/' . $baseLang . '.yml');

    if (!File::exists($filePath)) {
        return back()->with('msg', '<div class="alert alert-danger">Base language file not found.</div>');
    }

    $langData = Yaml::parseFile($filePath);

    // Translate
    $translator = new Translate(); // Make sure Translate class exists
    $translatedArray = $translator->get_translated_data_array($baseLang, $targetLang, $langData);

    // Dump YAML
    $yamlContent = Yaml::dump($translatedArray, 10, 2);

    // Save file
    $newFilePath = base_path('dbc_config/locals/' . $targetLang . '.yml');

    try {
        File::put($newFilePath, $yamlContent);

        Session::flash('msg', '<div class="alert alert-success">Language translated successfully.</div>');
    } catch (\Exception $e) {
        Session::flash('msg', '<div class="alert alert-danger">Unable to write file: ' . $e->getMessage() . '</div>');
    }

    return redirect()->route('system.translate'); // Update to your actual route
}

public function emailview()
{
    $emails = DB::table('emailtmpl')->get(); // Or your model like EmailTemplate::all()

    $selectedEmail = request('id')
        ? DB::table('emailtmpl')->where('id', request('id'))->first()
        : null;

    return view('dashboard.admin.system.emailview', compact('emails', 'selectedEmail'));
}
public function debugemail(){

    return view('dashboard.admin.system.debugemail');

}
    public function editprofile()
    {
        $user = Auth::user();
        $roles = Role::all();
        // The view will expect a 'profile' variable, so we pass the user object as 'profile'.
        return view('dashboard.admin.system.editprofile', ['profile' => $user, 'roles' => $roles]);
    }

    public function updateprofile(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'user_name' => 'required|string|max:255|unique:users,user_name,' . $user->id,
            'user_email' => 'required|string|email|max:255|unique:users,user_email,' . $user->id,
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|string|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'required|exists:roles,id',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'sometimes|required|string|min:8|confirmed';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $roles = Role::all();
            return view('dashboard.admin.system.editprofile', ['profile' => $user, 'roles' => $roles])
                   ->withErrors($validator);
        }

        $userData = $request->only([
            'user_name', 'user_email', 'first_name', 'last_name', 'gender', 'address', 'city', 'state', 'zip'
        ]);

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if it exists
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $userData['profile_photo'] = $path;
        }
        $user->update($userData);

        $user->syncRoles([$request->role_id]);

        // Update user meta for phone
        if ($request->has('phone')) {
            $user->meta()->updateOrCreate(
                ['user_id' => $user->id, 'key' => 'phone'],
                ['value' => $request->phone]
            );
        }

        return redirect()->route('system.editprofile', ['locale' => app()->getLocale()])->with('success', 'Profile updated successfully!');
    }

public function senddebugemail(Request $request)
{
    $request->validate([
        'to_email' => 'required|email',
    ]);

    // Get values from 'options' table where key is 'webadmin_email'
    $setting = Settings::where('key', 'webadmin_email')->first();

    if (!$setting) {
        return back()->with('error', 'Webadmin email settings not found.');
    }

    $values = json_decode($setting->values);

    $from_email = $values->webadmin_email ?? config('mail.from.address');
    $from_name  = $values->webadmin_name ?? config('mail.from.name');

    try {
        Mail::raw('This is a test debug email.', function ($message) use ($request, $from_email, $from_name) {
            $message->to($request->to_email)
                    ->from($from_email, $from_name)
                    ->subject('Test Debug Email');
        });

        return back()->with('success', 'Test email sent successfully!');
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to send email. ' . $e->getMessage());
    }
}
public function updateemail(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:emailtmpl,id',
        'subject' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    // Get the current email row
    $email = DB::table('emailtmpl')->where('id', $request->id)->first();

    if (!$email) {
        return redirect()->back()->with('error', 'Email template not found.');
    }

    // Decode current JSON values
    $values = json_decode($email->values, true);

    // Update subject and body
    $values['subject'] = $request->subject;
    $values['body'] = $request->body;

    // Retain avl_vars if exists in form
    if ($request->has('avl_vars')) {
        $values['avl_vars'] = $request->avl_vars;
    }

    // Save updated JSON
    DB::table('emailtmpl')->where('id', $request->id)->update([
        'values' => json_encode($values, JSON_UNESCAPED_UNICODE)
    ]);

    return redirect()->route('system.emailview', ['id' => $request->id])
        ->with('success', 'Email template updated successfully.');
}
public function generateSitemap(Request $request)
{
    // Get selected options
    $pages     = $request->has('pages');
    $blogs     = $request->has('blog_post');
    $estates   = $request->has('estate');

    // Start XML
    $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset/>');
    $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

    if ($pages) {
        // Add static page URLs
        $xml->addChild('url')->addChild('loc', url('/about'));
        $xml->addChild('url')->addChild('loc', url('/contact'));
        // Add more static pages as needed
    }

    if ($blogs) {
        $posts = \App\Models\BlogArticle::where('status', 1)->get();
        foreach ($posts as $post) {
            $url = $xml->addChild('url');
            $url->addChild('loc', url('/blog/' . $post->slug));
            $url->addChild('lastmod', $post->updated_at->toDateString());
        }
    }

    if ($estates) {
        $ads = \App\Models\Estate::where('status', 1)->get(); // or whatever model you're using
        foreach ($ads as $ad) {
            $url = $xml->addChild('url');
            $url->addChild('loc', url('/ads/' . $ad->slug));
            $url->addChild('lastmod', $ad->updated_at->toDateString());
        }
    }

    // Save to public/sitemap.xml
    $xml->asXML(public_path('sitemap.xml'));

    return back()->with('success', 'Sitemap generated successfully!');
}


function prepare_xml($urls = [])
{
    $base_url = base_url();
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

    // ✅ Homepage
    $xml .= "  <url>\n";
    $xml .= "    <loc>{$base_url}</loc>\n";
    $xml .= "    <priority>1.0</priority>\n";
    $xml .= "  </url>\n";

    // ✅ Other pages
    foreach ($urls as $url) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$url}</loc>\n";
        $xml .= "    <priority>0.5</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';
    return $xml;
}



}
