<?php
namespace common\models\mailer;

use Yii;

class AoMailer
{
    /**
     * @var string
     */
    private $sender = 'tasker@aoreal.sk';
    /**
     * @var null
     */
    private $template = null;
    /**
     * @var array
     */
    private $recipients = [];
    /**
     * @var array
     */
    private $recipientCC = [];
    /**
     * @var array
     */
    private $recipientBcc = [];
    /**
     * @var array
     */
    private $data = [];
    /**
     * @var null
     */
    private $subject = null;
    /**
     * @var null
     */
    private $message = null;

    /**
     * @param string $templateName
     */
    public function setTemplate (string $templateName): void
    {
        $this->template = $templateName;
    }

    /**
     * @param string $sender
     */
    public function setSender (string $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @param array $recipients
     */
    public function setRecipients (array $recipients): void
    {
        $this->recipients = $recipients;
    }

    /**
     * @param array $bccRecipients
     */
    public function setBcc (array $bccRecipients): void
    {
        $this->recipientBcc = $bccRecipients;
    }

    public function setCc (array $ccRecipients): void
    {
        $this->recipientCC = $ccRecipients;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function setMessage (string $message): void
    {
        $this->message = $message;
        
    }

    /**
     * @return void
     */
    public function sendHTMLMessage(): void
    {
        try {
            $mailer = Yii::$app->mailer;
            if (!is_null($this->message)) {
                $mailer
                    ->compose()
                    ->setHtmlBody($this->message)
                    ->setFrom($this->sender)
                    ->setTo($this->recipients)
                    ->setCharset('utf-8')
                    ->setSubject($this->subject)
                    ->send();
            } else {
                $mailer
                    ->compose(['html'=>$this->template],$this->data)
                    ->setFrom($this->sender)
                    ->setTo($this->recipients)
                    ->setCharset('utf-8')
                    ->setSubject($this->subject)
                    ->send();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function sendTextMessage(): void
    {
        try {
            $mailer = Yii::$app
                ->mailer;
            if (!is_null($this->message)) {
                $mailer
                    ->compose()
                    ->setTextBody($this->message)
                    ->setFrom($this->sender)
                    ->setTo($this->recipients)
                    ->setCharset('utf-8')
                    ->setSubject($this->subject)
                    ->send();
            } else {
                $mailer
                    ->compose(['text'=>$this->template],$this->data)
                    ->setFrom($this->sender)
                    ->setTo($this->recipients)
                    ->setCharset('utf-8')
                    ->setSubject($this->subject)
                    ->send();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

}