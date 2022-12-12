<?php

namespace App\Http\Controllers;

use App\Mail\GmailMail;
use App\Models\Author;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Nexmo\Laravel\Facade\Nexmo;

class MailController extends Controller
{
    public function viewSendEmailForm(): View
    {
        return view('emails.send-email');
    }

    public function sendEmail(Request $request):string
    {
//        $details = [
//            'title' => 'This Email Is From Laravel Application',
//            'body' => 'Welcome From Ahmed Abdelrhim',
//        ];

        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'msg' => 'required|string|min:10',
        ]);
        if($validate->fails())
            return redirect('email-send')->withErrors($validate)->withInput();
        $email = $request->get('email');

        $code = VerificationCode::query()->inRandomOrder()->first()->code;
        $msg = $request->get('msg');

        Mail::to($email)->send(new GmailMail($msg , $code));
        $request->session()->flash('success' , 'Email Sent Successfully');
        return redirect()->back();
        //return 'Email Sent Successfully';

    }

    public function checkVerificationCodeForm(): View
    {
        // return view('check-verification-code');
        return view('send-otp');
    }

    public function checkMobileNumber(Request $request)
    {
        // return strlen($request->get('mobile_no'));
        $validator = Validator::make( $request->all() ,[
            'mobile_no' => 'required|numeric|exists:authors,phone'
        ] ,
        [
            'mobile_no.required' => 'You Should Enter Your Mobile Number',
            // 'mobile_no.min' => 'Mobile Number Can Not Be Less Than 11 Numbers',
            // 'mobile_no.max' => 'Mobile Number Can Not Be More Than 11 Numbers',
            'mobile_no.exists' => 'Mobile Number Is Not Exists'
        ]
        );

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $otp = $this->generateVerificationCodeIfNotExists($request->get('mobile_no'));
        session()->flash('otp',$otp->otp);
        return redirect()->back();
    }

    public function generateVerificationCodeIfNotExists($mobile_no): object|string
    {
        $author = Author::query()->where('phone',$mobile_no)->first();
        if(!$author)
            return '';

        $otp = VerificationCode::query()->where('user_id',$author->id)->first();
        // return $author;
        if($otp && now()->isBefore($otp->expire_at))
            return $otp;
        return VerificationCode::create([
            'user_id' => $author->id,
            'otp' => random_int(123456,999999),
            'expire_at' => Carbon::now()->addMinutes(10),
        ]);
    }

    public function checkVerificationCode(Request $request): \Illuminate\Routing\Redirector|Application|RedirectResponse
    {
        $validator = Validator::make($request->all(),[
            'code' => 'required|numeric|min:4'
        ]);

        if($validator->fails())
            return redirect('check-verified-code')->withErrors($validator)->withInput();

        $code = $request->get('code');
        $code_exists = VerificationCode::query()
            ->where('code' , $code)->first();

        if(!$code_exists) {
            $request->session()->flash('not-found' , 'Code not exists');
            return redirect()->back();
        }


        $code_exists->delete();
        $request->session()->flash('success' , 'code checked success');
        return redirect()->back();
    }

    public function sendMailForm()
    {
        return view('emails.send_mail_form');
    }

    function send(Request $request)
    {

        $name = $request->get('name');
        $email = $request->get('email');
        $subject = $request->get('subject');
        $message = $request->message;
//        $data = ['content' => 'Anything'];
//        $message = view('email.temp', $data)->render();


        require 'PHPMailer/vendor/autoload.php';

        $mail = new PHPMailer(true);
//         return $request;
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = env('EMAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('EMAIL_USERNAME');
        $mail->Password = env('EMAIL_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 465;
        $mail->setFrom($email, $name);
        $mail->addAddress('aabdelrhim974@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $dt = $mail->send();
        if ($dt) {
            return 'Email has been sent successfully';
        } else {
            return 'Something went wrong';
        }

    }

    public function sendSms()
    {
//        Nexmo::message()->send([
//            'to'   => '2001152067271',
//            'from' => '+2001152067271',
//            'text' => 'Laravel SMS , Ahmed Abdelrhim .'
//        ]);

        try {
            $nexmo = app('Nexmo\Client');

            $nexmo->message()->send([
                'to'   => '+20 115 206 7271',
                'from' => '+20 115 206 7271',
                'text' => 'Laravel SMS , Ahmed Abdelrhim .'
            ]);
        } catch (Exception $e) {
            session()->flash('error','Something Went Wrong');
            return redirect()->back();
        }
    }

}
// anas.rabea1000@gmail.com aabdelrhim974  form('ahmedabdelrhim92@gmail.com')->
