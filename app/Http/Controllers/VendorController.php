<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\BoxPrice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VendorController extends Controller
{
    public function index(Request $request){
        $items = $request->input('items');
        $fromAddress = $request->input('fromAddress');
        $toAddress = $request->input('toAddress');
        $description = $request->input('description');
        $destination = static::calculateDistance($fromAddress['mapPosition']['lat'], $fromAddress['mapPosition']['lng'], $toAddress['mapPosition']['lat'], $toAddress['mapPosition']['lng']);
        $pickDate = $request->input('pickDate');
        $boxes = array_keys($items);
        $roleModal = (new (config('admin.database.roles_model')))->where('name', 'vendor')->first();
        $vendors = $roleModal->administrators()->get();
        $boxPrices = BoxPrice::whereIn('box_id', $boxes)->get();
        $prices = collect([]);
        foreach ($vendors as $vendor){
            $vendorPrice = $boxPrices->where('vendor_id', $vendor->id);
            $prices->push(collect([
                "vendor" => $vendor,
                "prices" => $vendorPrice,
                "total" => ceil($vendorPrice->sum(function ($price) use ($destination, $items) {
                    return $price->price * $items[$price['box_id']] * $destination;
                })),
            ]));
        }
        $prices= $prices->sortBy('total');

        return Inertia::render('compare', [
            "prices" => $prices->values(),
            "boxes" => $boxes,
            "fromAddress" => $fromAddress,
            "toAddress" => $toAddress,
            "description" => $description,
            "destination" => $destination,
            "pickDate" => $pickDate,
            "nextStep" => route('checkout'),
        ]);
    }
    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    public static function calculateDistance (
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius/1000;
    }
}
