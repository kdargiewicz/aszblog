<?php

namespace App\Web\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DTO\SendNotificationDTO;
use App\Mail\Services\MailService;
use App\Web\Models\Settings;
use App\Web\Requests\MailContactRequest;

class MailContactController extends Controller
{
    public function sendMailFromReader(MailContactRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        session()->forget('captcha_sum');

        $dto = new SendNotificationDTO(
            name: __('blog.contact.contact_subject', ['name' => $data['contact_name']]),
            email: app(Settings::class)->getRecipientEmail(),
            message: __('blog.contact.from_email', [
                'email' => $data['contact_email'] ?? __('blog.contact.no_email')
            ]),
            comment: $data['contact_message']
        );

        app(MailService::class)->submitContactEmail($dto);

        return redirect()->back()->with('success', __('flash-messages.email_send'));
    }
    ///tu zostawiam moje pożegnanie, ja Krzysztof iDargol Dargiewicz
    ///wkurza mnie to że trzeba umrzeć
    /// niby znowu sie rodzimy
    /// ale jaki jest sens
    /// skoro nie pamietamy poprzedniego życia
    /// może coś kojarzymy, tego nie wiem
    /// w tym życiu dopiero się dowiedziałem, że wracamy
    /// w następnym postaram się wiedzieć więcej
    /// to mi wypacza sens istnienia
    /// czy moi synowie to moi synowie? czy moze byli moimi ojcami?
    /// porąbane
    /// ale jednak najbardziej logiczne
    /// i to jest najbardziej ciekawe, oczywiście, jeśli się ktoś tym interesuje ;)
    /// Asia kocham CIę, zawsze Cię kochałem
    /// jesteś cudowną kobietą ;)
    /// zawsze sexy ;)
    /// tylko ja nie zawsze to dostrzegałem :(
    ///
    /// przepraszam...
    /// zawiodłem CIę tyle razy..
    /// a Ty się zawsze starałaś
    /// przepraszam
    ///
    ///
}
