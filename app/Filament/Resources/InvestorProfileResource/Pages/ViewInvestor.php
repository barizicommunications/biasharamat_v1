<?php

namespace App\Filament\Resources\InvestorProfileResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Models\InvestorProfile;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ViewRecord;
use App\Notifications\ApplicationAccepted;
use App\Notifications\ApplicationDeclined;
use App\Filament\Resources\InvestorProfileResource;

class ViewInvestor extends ViewRecord
{
    protected static string $resource = InvestorProfileResource::class;


    protected function getActions(): array
    {

      return [

        Action::make('Verify application')
        ->label('Verify application')
        ->color('success')
        ->icon('heroicon-o-book-open') ->action(function (array $data) {



            if(in_array(auth()->user()->registration_type, ["Admin"])){


               $application = InvestorProfile::where('id',$this->record->id)->first();




               $application->verification_status = "Accepted";
               $application->save();

               $user = User::where('id',$this->record->user_id)->first();


               $user->notify(new ApplicationAccepted($user));


               return redirect()->route('filament.admin.resources.investor-profiles.index');


            }


        })->hidden(function(){

            $application = InvestorProfile::where('id',$this->record->id)->first();

            if($application->verification_status === "Accepted" || $application->verification_status === "Declined"){
                return true;
            }

        }),



        Action::make('Decline application')
        ->label('Decline application')
        ->color('danger')
        ->icon('heroicon-o-book-open') ->action(function (array $data) {

            // dd($data);


            if(in_array(auth()->user()->registration_type, ["Admin"])){

               $application = InvestorProfile::where('user_id',$this->record->user_id)->first();

               $application->verification_status = "Declined";
               $application->reason_for_decline = $data['reason_for_decline'];
               $application->save();

               $user = User::where('id',$this->record->user_id)->first();

               $reason = $data['reason_for_decline'];


               $user->notify(new ApplicationDeclined($user,$reason));


               return redirect()->route('filament.admin.resources.investor-profiles.index');


            }


        })->form([
            Textarea::make('reason_for_decline')
            ->required()
            ->label('Reason for decline')
        ])->hidden(function(){

            $applicationStatus = InvestorProfile::where('user_id',$this->record->user_id)->first();

            if($applicationStatus->verification_status === "Accepted" || $applicationStatus->verification_status === "Declined"){
                return true;
            }

            return false;

        })


      ];

    }
}
