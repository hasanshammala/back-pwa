<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // إنشاء المنتج في قاعدة البيانات
        $product = Product::create($request->all());

        // إعداد الاتصال بـ Firebase
        $firebase = (new \Kreait\Firebase\Factory())
            ->withServiceAccount('C:/Users/Administrator/Desktop/pwa_and_firebase_cm/ex/config/test-6faeb-firebase-adminsdk-i2a5t-d44a0db58c.json');


        // الحصول على خدمة الإشعارات
        $messaging = $firebase->createMessaging();

        // إعداد الإشعار
        $message = [
            'notification' => [
                'title' => 'منتج جديد!',
                'body' => 'تمت إضافة المنتج: ' . $product->name,
            ],
            'topic' => 'products', // الموضوع الذي سنرسل الإشعار له
        ];

        // إرسال الإشعار
        $messaging->send($message);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $product->update($request->all());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(null, 204);
    }
}
