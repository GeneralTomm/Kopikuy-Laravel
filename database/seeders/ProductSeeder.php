<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = '[
                    {"id":2, "category":"Coffee","product":"Strawberry ice Coffee","image":"product\/63QyevuCQPDSBf1KhBayMj7DEw5fCOK20h1br34z.png","price":"20000","status":"open","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi iste illum ex suscipit rem, sequi reprehenderit in ducimus mollitia culpa deserunt cumque eligendi a dolor veniam voluptas temporibus consequuntur? Unde.","created_at":"2021-09-30T14:04:12.000000Z","updated_at":"2021-10-01T12:33:04.000000Z"},
                    {"id":3, "category":"Susu","product":"Strawberry Juice flavour with cream","image":"product\/x5tEomEW6h0lnDeaN9Fgtc7Lab98yZUIwfclBKHr.png","price":"30000","status":"open","description":"Ini adalah produk terbaru kami yang kami racik sendiri dengan gabungan eskrim dan juga jus buah stroberry dengan kualitas terbaik","created_at":"2021-10-01T00:09:42.000000Z","updated_at":"2021-10-01T12:33:14.000000Z"},
                    {"id":4, "category":"Coffee","product":"Almon Coffeee Cream","image":"product\/NjGTKlSDqW6LGJrQw6JwDIzYDvsfMkjWGev2tVoJ.png","price":"50000","status":"open","description":"Ini adalah produk terbaru kami dari Kopikuy","created_at":"2021-10-01T00:13:54.000000Z","updated_at":"2021-10-01T12:33:21.000000Z"},
                    {"id":5, "category":"Tea","product":"Green Matcha Tea With Ice Cream","image":"product\/U6JXmqFy55LrqGR9SdAdxx9m1HDJnJ9dvlqVQrNh.png","price":"100000","status":"open","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet temporibus cum consectetur maxime minima corporis quae ea distinctio possimus molestiae recusandae, placeat quaerat veritatis? Modi voluptatem quia ullam tenetur id.","created_at":"2021-10-01T03:09:47.000000Z","updated_at":"2021-10-01T12:33:28.000000Z"},
                    {"id":6, "category":"Tea","product":"Green Tea with Matcha ice cream","image":"product\/g3GGcPt6lhMES9lpoYpoBEIGzsDmPEGmEhFlgvvf.png","price":"40000","status":"open","description":"ini adalah menu kami dimana kami memadukan teh matcha hijau dengan eskrim vanilla yang dicampur dengan matcha hijau , sensai dingin yang sangat cocok jika di konsumsi saat cuaca sedasng panas","created_at":"2021-10-01T09:49:16.000000Z","updated_at":"2021-10-01T12:33:37.000000Z"},
                    {"id":7, "category":"Coffee","product":"Sweet Caramel Ice cream with Coffee","image":"product\/8ItdThAYOCCcLooLinQEcEXumNjWzEYs2YIG8Qqv.png","price":"50000","status":"open","description":"Ini adalah menu yang terbaik dari restoran kami dimana kami menyediakan sebuah produk kopi dengan topingan karamel dan juga es krim vanilla","created_at":"2021-10-01T09:50:54.000000Z","updated_at":"2021-10-01T12:33:45.000000Z"},
                    {"id":8, "category":"Tea","product":"Green Matcha Milk","image":"product\/uZNLrP0XphaSOFJIgORoZf2rWAE2lCkuiRlv4Dgd.png","price":"30000","status":"open","description":"Ini adlah susu dengan campuran matcha green tea yang di berikan toping dari susu kental dari matcha","created_at":"2021-10-01T09:52:48.000000Z","updated_at":"2021-10-01T12:33:54.000000Z"},
                    {"id":9, "category":"Susu","product":"chocholate Milk Shake with ice cream","image":"product\/BpNs7clt71NDawwk4MMRi3bX3Bqy4AJtI4a1L3mk.png","price":"60000","status":"open","description":"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ratione, ut possimus sapiente illo, exercitationem omnis, aperiam nemo maxime quod inventore corrupti ab unde rem laboriosam. Dolorum, optio? Similique, voluptatibus ab?","created_at":"2021-10-01T10:27:55.000000Z","updated_at":"2021-10-01T12:34:02.000000Z"},
                    {"id":10,"category":"Susu","product":"Oreo Ice Cream Milk Shake","image":"product\/2ItAiITHhtl64Q0rJqsovYPcELpwO7YHbD3W9elz.png","price":"65000","status":"open","description":"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione, optio aperiam. Aperiam explicabo saepe vero quis optio tempore fugit commodi soluta eligendi, non quisquam nulla consequatur doloremque, veniam suscipit alias!","created_at":"2021-10-01T12:34:41.000000Z","updated_at":"2021-10-01T12:34:41.000000Z"}
                ]';
        $obj = json_decode($data);
        foreach ($obj as $product) {
            Product::create([
                'product'=>$product->product,
                'image'=>$product->image,
                'price'=>$product->price,
                'category'=>$product->category,
                'status'=>$product->status,
                'description'=>$product->description
            ]);
        }
    }
}
