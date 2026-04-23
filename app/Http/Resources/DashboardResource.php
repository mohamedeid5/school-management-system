<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'studentsCount'    => $this['studentsCount'],
            'teachersCount'    => $this['teachersCount'],
            'classroomsCount'  => $this['classroomsCount'],
            'examsCount'       => $this['examsCount'],
            'libraryCount'     => $this['libraryCount'],
            'onlineClassCount' => $this['onlineClassCount'],

            'todayPresent' => $this['todayPresent'],
            'todayAbsent' => $this['todayAbsent'],
            'todayLate' => $this['todayLate'],
            'todayExcused' => $this['todayExcused'],

            'totalInvoices' => $this['totalInvoices'],
            'totalPayments' => $this['totalPayments'],

            'recentStudents' => StudentResource::collection($this['recentStudents']),
            'recentInvoices' => $this['recentInvoices'],
        ];
    }
}
