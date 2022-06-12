<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Company;
use App\Models\Department;
use App\Models\Document;
use App\Models\File;
use App\Models\Notification;
use App\Models\Position;
use App\Models\Profile;
use App\Models\Reply;
use App\Models\Sender;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Turn;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();

        $statuses = Status::factory(5)->create();

        $companies = Company::factory(10)->create();

        $senders = Sender::factory(20)->make()
            ->each(function ($sender) use ($companies) {
                $sender->company_id = $companies->random()->id;
                $sender->save();
            });

        $tags = Tag::factory(5)->create();

        $departments = Department::factory(10)->create()
            ->each(
                function ($department) {
                    $department->profile()->save(Profile::factory()->make());
                }
            );

        $positions = Position::factory(10)->make()
            ->each(
                function ($position) use ($departments) {
                    $position->department_id = $departments->random()->id;
                    $position->save();
                    $position->profile()->save(Profile::factory()->make());
                }
            );

        $profiles = Profile::get();

        $documents = Document::factory(50)->make()
            ->each(function ($document) use ($users, $statuses, $profiles,$tags,$senders) {
                $document->user_id = $users->random()->id;
                $document->status_id = $statuses->random()->id;
                $document->profile_id = $profiles->random()->id;
                $document->save();
                for ($i = 0; $i <= rand(1, 3); $i++) {
                    $document->files()->save(File::factory()->make());
                }
                foreach($tags as $tag) {
                    if (rand(1, 10) > 5) {
                        $document->tags()->attach($tag);
                    }
                }
                $document->senders()->attach(Sender::find($senders->random()->id));
            });
        $turns = Turn::factory(100)->make()
            ->each(function ($turn) use ($documents, $users) {
                $turn->document_id = $documents->random()->id;
                $turn->user_id = $users->random()->id;
                $turn->save();
                for ($i = 0; $i <= rand(1, 3); $i++) {
                    $turn->files()->save(File::factory()->make());
                }
            });

        $replies = Reply::factory(10)->make()
            ->each(
                function ($reply) use ($turns, $users) {
                    $reply->user_id = $users->random()->id;
                    $reply->turn_id = $turns->random()->id;
                    $reply->save();
                    for ($i = 0; $i <= rand(1, 3); $i++) {
                        $reply->files()->save(File::factory()->make());
                    }
                }
            );

        $comments = Comment::factory(30)->make()
            ->each(
                function ($comment) use ($turns, $users) {
                    $comment->user_id = $users->random()->id;
                    $comment->turn_id = $turns->random()->id;
                    $comment->save();
                    $comment->file()->save(File::factory()->make());
                }
            );
    }
}
