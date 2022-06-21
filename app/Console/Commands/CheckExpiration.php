<?php

namespace App\Console\Commands;

use App\Mail\SendMessage;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check_expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Исключить всех пользователей, у которых expired_at меньше текущего момента, из групп';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $users = User::whereHas('groups', function($query) {
            $query->where('expired_at', '>', now());
        })->get();

        if (!$users->isEmpty()) {
            $users->each(function ($user) {
                foreach ($user->groups as $group) {
                    $user->groups()->detach($group);

                    /**
                     * Отправка Email
                     */
                    Mail::to($user->email)->send(new SendMessage($user->name, $group->name));
                }

                /**
                 * Если у пользователя не осталось активных групп, тогда is_active = false
                 */
                $currentUser = User::whereHas('groups')->find($user->id);
                if (!isset($currentUser)) {
                    $user->is_active = false;
                    $user->save();
                }
            });
        }

        return 0;
    }
}
