<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Extras\Models\Announcement\Links as Linkable;
use App\Extras\Models\Announcement\Access as Accessible;
use App\Extras\Models\Announcement\Filters as Filterable;
use App\Extras\Models\Announcement\Appends as Appendable;

class Announcement extends Model
{

    use Accessible, Filterable, Linkable, Appendable;

    const ADMINISTRATOR = 'administrator';
    const ASSETS_MANAGEMENT = 'assets management';
    const ACCOUNTING = 'accounting';
    const OFFICES = 'offices';
    const ALL = 'all';

    const DEFAULT_ACCESS_NUMBER = 4;

    protected $table = 'announcements';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public static $_instance;

    /**
     * List of columns in the database that
     * can be filled using the create method
     * of the model
     *
     * @var array
     */
    protected $fillable = [
    	'title', 'details', 'access', 'user_id'
    ];

    /**
     * Additional columns when fetching records
     * These columns are automatically added when
     * the model is initialized
     *
     * @var array
     */
    protected $appends = [
        'created_by'
    ];
    
    /**
     * Create an announcement based on the arguments
     * given. The argument field accepts the following
     * as attributes: title, details, access, and users
     *
     * @param array $args
     * @return void
     */
    public function notify(array $args)
    {
        Announcement::create([
            'title' => $args['title'],
            'details' => $args['details'],
            'access' => isset($args['access']) ? $args['access'] : self::DEFAULT_ACCESS_NUMBER,
            'user_id' => Auth::id(),
            'specified_users' => $args['users'],
        ]);

        return $this;
    }

}
