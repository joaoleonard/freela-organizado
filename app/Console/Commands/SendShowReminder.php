<?php

namespace App\Console\Commands;

use App\Helpers\WppConnectionApi;
use Illuminate\Console\Command;

class SendShowReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-show-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send WhatsApp reminders to musicians about today\'s show';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->format('Y-m-d');
        $shows = \App\Models\Show::whereDate('show_date', $today)->get();

        if ($shows->isEmpty()) {
            $this->info('No shows scheduled for today.');
            return;
        }

        foreach ($shows as $show) {
            $this->sendReminder($show);
        }

        $this->info('WhatsApp reminders sent successfully.');
    }

    private function sendReminder($show)
    {
        $phone = $show->user->phone;
        $message = "*Olá {$show->user->name}!* \n\nPassando para lembrar do seu show hoje em *{$show->restaurant->name}* 🎶 \nNão se esqueça de levar todos os equipamentos necessários! 🎤🎸 \nFaça um bom show! \n\n*Freela Organizado*";

        $wppConnectApi = app(WppConnectionApi::class);
        $response = $wppConnectApi->notification($phone, $message);

        if ($response->status == 'success') {
            $this->info("Reminder sent to {$show->user->name} at {$phone}");
        } else {
            $this->error("Failed to send reminder to {$show->user->name} at {$phone}");
        }
    }
}
