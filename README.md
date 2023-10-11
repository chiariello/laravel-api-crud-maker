# Create API CRUD with filters

Create API CRUD with filters in Laravel project

## Installation

Via composer:

```bash
composer require chiariello/laravel-api-crud-maker
```
Add FilterServiceProvider and RequestServiceProvider in config/app.php
```php
    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Chiariello\LaravelApiCrudMaker\Providers\FilterServiceProvider::class, // <-- Add This
        Chiariello\LaravelApiCrudMaker\Providers\RequestServiceProvider::class, // <-- Add This
    ])->toArray(),
```
## Usage

Create new model with migration and controller:
```bash
composer php artisan make:model Flight --migration --controller
```
Edit the migration as you want
```php
Schema::create('flights', function (Blueprint $table) {
    $table->id();
    $table->string('departure');
    $table->string('destination');
    $table->timestamps();
});
```

Add HasFilters trait and fillables attributes in model

```php
namespace App\Models;

use Chiariello\LaravelApiCrudMaker\Traits\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory, HasFilters;

    protected $fillable = [
        'departure',
        'destination'
    ];
}
```
Extend CrudController and set $model attribute in Controller class
```php
namespace App\Http\Controllers;

use App\Models\Flight;
use Chiariello\LaravelApiCrudMaker\Controllers\CrudController;

class FlightController extends CrudController
{
    protected string $model = Flight::class;
}
```
Create Filter class under app/Filters the class must have {ModelName}Filter.php name
(in this example FlightFilters.php).

Now you need to set the filters array and insert every attribute filter and
create a method for every filter.
```php
namespace App\Filters;

use Chiariello\LaravelApiCrudMaker\Filters\AbstractFilters;

class FlightFilters extends AbstractFilters
{
    protected array $filters = [
        'departure',
        'destination'
    ];
    
    public function departure(string $departure)
    {
        $this->like('departure', $departure);
    }
    
    public function destination(string $destination)
    {
        $this->like('destination', $destination);
    }
    
}
```
create a form request with this name convention {{ModelName}}Request.php
```bash
php artisan make:request FlightRequest
```
Set validation and create and update logic.
```php
namespace App\Http\Requests;

use App\Models\Flight;
use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function persist(){

        if($this->id){
            return Flight
                ::findOrFail($this->id)
                ->update($this->all());
        }
        return Flight::create($this->all());
    }
}
```
add Route in api.php
```php
use App\Http\Controllers\FlightController;
use Chiariello\LaravelApiCrudMaker\Utils\RouteUtility;

RouteUtility::controllerRoutes(FlightController::class,'flights');
```
## Credits

- [Salvatore Chiariello](https://github.com/chiariello)
