use App\Http\Controllers\Api\StdentController;

Route::post('/students', [StdentController::class, 'store']);
