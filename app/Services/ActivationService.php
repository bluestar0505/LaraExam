<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 11.12.2017
 * Time: 16:52
 */

namespace App\Services;


use App\Notifications\ActivationLinkMail;
use App\Mail\Reminder;
use App\Repositories\ActivationRepository;
use App\User;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Mail;
class ActivationService
{
    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(Mailer $mailer, ActivationRepository $activationRepo)
    {
        $this->mailer = $mailer;
        $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {

//        if ($user->email_verified || !$this->shouldSend($user)) {
        if ($user->email_verified) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);

        Mail::to($user)->send(new Reminder($link));
//        $message = sprintf('Activate account link: %s', $link);

//        $this->mailer->raw($message, function (Message $m) use ($user) {
//            $m->to($user->email)->subject('Activation mail');
//        });
    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);
        $user->email_verified = true;
        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;

    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }
}