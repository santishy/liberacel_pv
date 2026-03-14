<?php

namespace App\Http\Middleware;

use App\Models\Inventory;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureInventoryContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs(
            'select-inventory', 'select.inventory.store', 'login', 'register'
        )) {
            return $next($request);
        }
        if (session()->has('inventory_id')) {
            return $next($request);
        }

        $user = auth()->user();

        if ($user->inventory_id) {
            session(['inventory_id' => $user->inventory_id]);

            return $next($request);
        }
        $count = Inventory::count();

        if ($count === 1) {
            session(['inventory_id' => Inventory::value('id')]);

            return $next($request);
        }

        return redirect()->route('select-inventory');
    }
}
