<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Review extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Update doctor's review_avg when a review is created
        static::created(function ($review) {
            \Log::info("Review created for doctor {$review->doctor_id}, updating average");
            if ($review->doctor) {
                // Use DB::afterCommit to ensure the review is committed before calculating average
                \DB::afterCommit(function () use ($review) {
                    $review->doctor->updateReviewAverage();
                });
            }
        });

        // Update doctor's review_avg when a review is updated (especially when approved)
        static::updated(function ($review) {
            // Check if the approval status changed or rating changed
            if ($review->wasChanged('approved') || $review->wasChanged('rating')) {
                \Log::info("Review {$review->id} updated for doctor {$review->doctor_id}, updating average. Approved changed: " . ($review->wasChanged('approved') ? 'yes' : 'no'));
                if ($review->doctor) {
                    \DB::afterCommit(function () use ($review) {
                        $review->doctor->updateReviewAverage();
                    });
                }
            }
        });

        // Update doctor's review_avg when a review is deleted
        static::deleted(function ($review) {
            \Log::info("Review {$review->id} deleted for doctor {$review->doctor_id}, updating average");
            if ($review->doctor) {
                \DB::afterCommit(function () use ($review) {
                    $review->doctor->updateReviewAverage();
                });
            }
        });
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}