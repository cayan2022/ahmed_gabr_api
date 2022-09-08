<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\Filterable;
use App\Http\Filters\OrderFilter;

class Order extends Model
{
    use HasFactory , Filterable;

    protected $fillable = [
        'user_id',
        'category_id',
        'source_id',
        'status_id',
        'branch_id'
    ];

    protected $appends = ['last_employee','employee_avatar'];

    protected $filter = OrderFilter::class;

    public const NEW=1;
    public const FOLLOWING=2;
    public const Paid=3;
    public const Fail=4;

    /*
     * patient relation
     * */
    public function user()
    {
        return $this->belongsTo(User::class); //->where('type','patient')
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function histories()
    {
        return $this->hasMany(OrderHistory::class,'order_id')->latest();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function getLastEmployeeAttribute()
    {

        return $this->histories->last()->employee->name ?? null;
    }

    public function getEmployeeAvatarAttribute()
    {

        return count($this->histories) > 0 ? $this->histories->last()->employee->getAvatar() : null;
    }

}
