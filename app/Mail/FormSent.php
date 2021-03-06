<?php

namespace App\Mail;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSent extends Mailable
{
    use Queueable, SerializesModels;

    public $form;
    public $isAdmin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $formId, $isAdmin = false)
    {

        $this->form = Form::with(['user'])->find($formId);
        $this->isAdmin=$isAdmin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.form-sent');
    }
}
