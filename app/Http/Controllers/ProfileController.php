<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Restaurant;
use App\Models\OrderProduct;
use Hash;
use Auth;
use PDF;

class ProfileController extends Controller
{
    public function index()
    {
        $country = Country::all();
        $state = State::all();
        $city = City::all();

        #address
        // $address = Address::where('addresable_id',auth()->user()->id)->first();
        $address=Address::where('addresable_type', 'App\Models\User')->where('addresable_id', Auth::user()->id)->orderBy('id','desc')->get();
        $default_address_id=Auth::user()->default_address_id;

        $user_id=Auth::user()->id;
        // $orders=Order::with('getOrderProducts.getproductsData')->where([['user_id',$user_id],['payment_status','=','confirm']])->orderBy('id','desc')->get();
        $orders = Order::with(['getOrderProducts.getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where([['user_id',$user_id],['payment_status','=','captured']])->orderBy('id', 'asc')->get();
        #Reservation
        $reservation = Reservation::where('user_id',auth()->user()->id)->orderBy('id','desc')->limit(10)->get();
        return view('pages.user.profile.index',compact('country','address','default_address_id','orders','state','city','reservation'));
    }

    public function fetchState (Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
                                ->get(["name", "id"]);

        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)
                                    ->get(["name", "id"]);

        return response()->json($data);
    }

    public function address(Request $request)
    {
        $user = new User;
        $address = new Address;
        $address->street = $request->street;
        $address->landmark = $request->landmark;
        $address->pincode = $request->pincode;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->atype = $request->address_type;
        $address->addresable_id = auth()->user()->id;
        $address->addresable_type = get_class($user);
        $address->save();

        if ($address) {
            if (isset($request->default_address_id) && $request->default_address_id!='' && $request->default_address_id=='yes') {
            $users=Auth::user();
            $users->default_address_id=$address->id;
            $users->save();
            }
        }
        return back()->with('success', 'Address Added Successfully');
    }

    public function ChangePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        // old password match...
        if(!Hash::check($request->old_password, $user->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }
        // Update the new Password....
        $user->update([
            'password' => Hash::make($request->new_password),
            'confirm_password' => Hash::make($request->confirm_password)
        ]);
        return back()->with('success', 'Password Change Successfully');
    }

    public function UpdateDefaultAddress(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->default_address_id = $request->address_id;
        $user->save();

        return response()->json(['success'=>'Default address updated.']);
    }

    public function OrderDetails(Request $request,$id)
    {
        $customer_id=Auth::user()->id;
        // $order=Order::where('id',$id)->with('getOrderProducts.getproductsData')->firstOrFail();
        $order = Order::with(['getOrderProducts.getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where('id',$id)->firstOrFail();
        if($order->user_id!=$customer_id)
        {
            return redirect()->route('home')->with('error', trans('translation.not_found'));
        }
        $billing_address=Address::where('addresable_id',$id)->where('atype','billing')->first();
        $shipping_address=Address::where('addresable_id',$id)->where('atype','shipping')->first();
        return view('pages.user.profile.order-details',compact('order','billing_address','shipping_address'));
    }

    public function address_destroy($id)
    {
        $data = Address::find($id);
        $delete = $data->delete();
        return back()->with('error', 'Address Deleted Successfully');
    }

    public function UpdateProfile(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if($user->phone_number == $request->phone_number) {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->save();
            return back()->with('success', 'Profile Updated Successfully');
        } else {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->verified_phone_number = 0;
            $user->save();
            return redirect()->route('otp.login')->with('success', 'Profile Updated Successfully');
        }
    }

    public function GetAddress(Request $request)
    {
        $address = address::find($request->id);
        return response()->json($address);
    }

    public function UpdateAddress(Request $request)
    {
        $id = $request->address_id;
        $address = address::find($id);
        $address->street = $request->street;
        $address->landmark = $request->landmark;
        $address->pincode = $request->pincode;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->save();
        return redirect()->back()->with('success', 'Address Updated Successfully');
    }

    public function ReservationView($id)
    {
        $user_id=Auth::user()->id;

         $order = Order::with(['getOrderProducts.getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where([['user_id',$user_id],['payment_status','=','captured']])->where('tbl_reservation_id',$id)->orderBy('id', 'asc')->first();

        if ($order == null) {
            return back()->with('error','Please Order Product On this reservation');
        }
        return view('pages.user.profile.reservation-view',compact('order'));
    }

    public function ProductReview(Request $request,$id)
    {
        $product = Product::where('id',$id)->firstOrFail();
        $productReview = ProductReview::where('product_id',$id)->where('user_id',auth()->user()->id)->first();
        if ($productReview != null) {
            if ($id == $productReview->product_id && auth()->user()->id == $productReview->user_id) {
                return back()->with('error','You have already Review this Product');
            }
        }

        return view('pages.user.profile.product-review',compact('product'));
    }

    public function StoreProductReview(Request $request)
    {
        $request->validate(
            [
                'star' => 'required',
                'description' => 'required',
            ],
            [
                'star.required' => trans('translation.required', ['name' => 'product']),
                'description.required' => trans('translation.required', ['name' => 'product id']),
            ]
        );
        $review = new ProductReview();
        $review->rating = $request->star;
        $review->description = $request->description;
        $review->product_id = $request->product_id;
        $review->restaurant_id = $request->restaurant_id;
        $review->user_id = Auth::user()->id;
        $review->save();

        if (isset($request->choose_file)) {
            $uploadFile = $request->choose_file;
            $review_image = $uploadFile->hashName();
            $path = $uploadFile-> move(public_path('images/review_image'), $review_image);
            // Compress the uploaded image
            // $compressedPath = $this->compressImage($path);
            $review->image = $review_image;
            $review->save();
        }

        return redirect()->route('user.profile')->with('success','product review add successfully');
    }

    public function downloadPDF($id)
    {

        $order = Order::findOrfail($id);
        $restaurant = Restaurant::where('id',$order->restaurant_id)->first();
        $restaurant_address = Address::where('addresable_id', $restaurant->id)->where('addresable_type', 'App\Models\Restaurant')->first();
        // $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $id)->orderBy('id', 'asc')->get();
        $OrderProduct = OrderProduct::with(['getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where('order_id', $id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('addresable_id', $id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('addresable_id', $id)->where('atype', 'shipping')->first();

        $pdf = PDF::loadView('pages.restaurant.orders.invoice', array('restaurant' =>  $restaurant,'restaurant_address'=>$restaurant_address,'order'=>$order,'OrderProduct'=>$OrderProduct))
        ->setPaper('a4', 'portrait');

        return $pdf->download('invoice.pdf');
    }

}
