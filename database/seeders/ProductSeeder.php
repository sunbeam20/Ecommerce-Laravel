<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $numberOfUsers = 5;
        for ($i = 1; $i <= $numberOfUsers; $i++) {
            Shop::create([
                'email' => 'test' . $i . '@test.com',
                'user_name' => 'user' .$i,
                'name' => 'Shop' . $i,
                'password' => Hash::make('12345678'),
                'address' => 'Address' . $i,
                'city' => 'City' . $i,
                'state' => 'State' . $i,
                'zip' => '6300' . $i,
            ]);
        }

        $clothingProducts = [
            [
                'name' => 'T-Shirt',
                'description' => 'Comfortable cotton t-shirt',
                'price' => 19.99,
                'image' => 'tshirt.png', 'category_id' => 2,
                'stock' => 25
            ],
            [
                'name' => 'Jeans',
                'description' => 'Stylish blue jeans',
                'price' => 49.99,
                'image' => 'jeans.png', 'category_id' => 2,
                'stock' => 16
            ],
            [
                'name' => 'Jacket',
                'description' => 'Warm winter jacket',
                'price' => 99.99,
                'image' => 'jacket.png', 'category_id' => 2,
                'stock' => 39
            ],
            [
                'name' => 'Cap',
                'description' => 'Cool baseball cap',
                'price' => 14.99,
                'image' => 'cap.png', 'category_id' => 2,
                'stock' => 100
            ],
            [
                'name' => 'Sweater',
                'description' => 'Cozy wool sweater',
                'price' => 29.99,
                'image' => 'sweater.png', 'category_id' => 2,
                'stock' => 84
            ],
            [
                'name' => 'Hoodie',
                'description' => 'Warm hooded sweatshirt',
                'price' => 39.99,
                'image' => 'hoodie.png', 'category_id' => 2,
                'stock' => 54
            ],
            [
                'name' => 'Polo Shirt',
                'description' => 'Classic polo shirt',
                'price' => 24.99,
                'image' => 'poloshirt.png', 'category_id' => 2,
                'stock' => 61
            ],
            [
                'name' => 'Dress',
                'description' => 'Elegant evening dress',
                'price' => 79.99,
                'image' => 'dress.png', 'category_id' => 2,
                'stock' => 247
            ],
            [
                'name' => 'Shorts',
                'description' => 'Casual shorts',
                'price' => 19.99,
                'image' => 'shorts.png', 'category_id' => 2,
                'stock' => 61
            ],
            [
                'name' => 'Sweatpants',
                'description' => 'Comfortable sweatpants',
                'price' => 34.99,
                'image' => 'sweatpants.png', 'category_id' => 2,
                'stock' => 97
            ],
            [
                'name' => 'Fossil Women Watch',
                'description' => 'Brand: Fossil,
                    Round rose gold-tone watch with crystal-studded bezel, three textured subdials, crystal indices, and fluted crown
                    38 mm stainless steel case with mineral dial window
                    Quartz movement with analog display',
                'price' => 517.99,
                'image' => 'watch1.jpg',
                'stock' => 25,  'category_id' => 2,
                'brand' => 'fossil'
            ],
            [
                'name' => 'Titan Women Watch',
                'description' => 'Brand: Titan,
                    Dial Color: Silver , Case Shape: Round, Dial Glass Material: Mineral
                    Band Color: Gold, Band Material: Metal
                    Watch Movement Type: Quartz, Watch Display Type: Analog
                    Case Material: Stainless Steel, Case Diameter: 29millimeters
                    Water Resistance Depth: 30 meters',
                'price' => 249.99,
                'image' => 'watch2.jpg',
                'stock' => 76,  'category_id' => 2,
                'brand' => 'fossil'
            ],
            [
                'name' => 'Mens Lightweight Jacket',
                'description' => 'Brand: Zara,
                    GOLF JACKET: This jacket is the perfect outer layer for a day out on the water. Nautica’s versatile jacket has a water resistant shell for performance or simply a comfy casual look for everyday.
                    DESIGN: Nautica’s stretch poly blend jacket is designed to fit comfortably all day. It is both lightweight and breathable but still protects you from harsh elements such as wind and water.',
                'price' => 419.99,
                'image' => 'jacket1.jpg',
                'stock' => 20,  'category_id' => 2,
                'brand' => 'Zara'
            ],
            [
                'name' => 'Mens Stretch jacket',
                'description' => 'Brand: Zara,
                    REVERSIBLE JACKET: This puffer jacket is a must have! Fashioned with a stretchy blend and a zipper closure. Can be worn in two ways. Machine washable.
                    COMPOSITION: This high quality jacket is true to size and made from a stretchy blend designed for maximum comfort.',
                'price' => 245.99,
                'image' => 'jacket2.jpg',
                'stock' => 25,  'category_id' => 2,
                'brand' => 'Zara'
            ],
            [
                'name' => ' Mens White Shirt',
                'description' => 'Brand: Zalora,
                    Wrinkle Free: Developed for less wrinkles and easy care
                    Fitted Fit: Roomier through the shoulders, chest and arms, with a tapered waist
                    Point Collar: Classic collar thought to lengthen the face & allows for tie knot variety; can be worn with or without neckwear.',
                'price' => 151.99,
                'image' => 'whiteshirt.jpg',
                'stock' => 25,  'category_id' => 2,
                'brand' => 'Zalora'
            ],
            [
                'name' => 'Mens Black Shirt',
                'description' => 'Brand: Zalora,
                    Wrinkle Free: Developed for less wrinkles and easy care
                    Fitted Fit: Roomier through the shoulders, chest and arms, with a tapered waist
                    Point Collar: Classic collar thought to lengthen the face & allows for tie knot variety; can be worn with or without neckwear.',
                'price' => 151.99,
                'image' => 'blackshirt.jpg',
                'stock' => 100,  'category_id' => 2,
                'brand' => 'Zalora'
            ],
            [
                'name' => 'AnneKlein Womens  Top',
                'description' => 'Brand: Anne Klein,
                    Sleeveless top in stretch knit featuring V-neckline with folded pleat texture',
                'price' => 122.99,
                'image' => 'whitetop.jpg',
                'stock' => 25,  'category_id' => 2,
                'brand' => 'Anne Klein'
            ],
            [
                'name' => 'Womens Black Top',
                'description' => 'Superior in material and excellent in workmanship.Material: cotton rayon .Comfortable and lightweight. (Loose fit,if you dont like loose,please order a size smaller down.)
                    Flowers embroidered. Its actually embroidery. Gorgeous embroidery!',
                'price' => 111.99,
                'image' => 'blacktop.jpg',  'category_id' => 2,
                'stock' => 115
            ],
            [
                'name' => 'Wrangler Mens Jeans',
                'description' => 'COMFORT FLEX WAISTBAND: Constructed with comfort in mind - our innovative flex waistband with stretch denim bands ensure a comfortable fit that moves and bends with you
                    REGULAR FIT: Built with a regular fit seat and thigh, these five-pocket regular fit jeans sit at the natural waist for a comfortable fit',
                'price' => 206.99,
                'image' => 'jeans1.jpg',  'category_id' => 2,
                'stock' => 25
            ],
            [
                'name' => 'Charhatt Mens Jeans',
                'description' => 'Brand: Charthatt,
                    Carhartt Company Gear Collection
                    Copy points should be: 12-ounce, 86% Cotton/14% Polyester denim
                    Sits at the waist
                    Comfortable fit through the seat and thigh with more room to move
                    Stronger sewn-on-seam belt loops',
                'price' => 107.99,
                'image' => 'jeans2.jpg',
                'stock' => 35,  'category_id' => 2,
                'brand' => 'Charhatt'
            ],
            [
                'name' => 'Gavin Blue T-Shirt Men',
                'description' => 'Brand: Gavin Bleu,
                    Mens cotton polo shirts, comfortable & breathable mesh pique fabric
                    Regular fit polo shirts for men, short sleeves with ribbed armbands
                    Mens collared polo shirts, stand collar with color block neckline, two-button placket',
                'price' => 201.99,
                'image' => 'Black1.jpg',
                'stock' => 75,  'category_id' => 2,
                'brand' => 'Gavin Bleu'
            ],
            [
                'name' => 'Unisex Black Cap',
                'description' => 'Brand: columbia,
                    OMNI-WICK - The ultimate moisture management technology for the outdoors. Omni-Wick quickly moves moisture from the skin into the fabric where it spreads across the surface to quickly evaporate—keeping you cool and your clothing dry.',
                'price' => 107.99,
                'image' => 'blackcap.jpg',
                'stock' => 25,  'category_id' => 2,
                'brand' => 'Columbia'
            ],
            [
                'name' => 'Classic Leather Belt',
                'description' => ' Brand: Timberland,
                    Mens leather belt made with 100% genuine leather with single loop antique finish buckle
                    Perfect mens casual belt that will soon become your favorite go to everyday leather belt
                    The perfect mens belt for jeans that can also convert into a mens dress belt and work belt
                    Sizing: 1. 25" Wide, Order 1 size larger than your pant size for the best fit',
                'price' => 57.99,
                'image' => 'belt1.jpg',
                'stock' => 50,  'category_id' => 2,
                'brand' => 'Timberland'
            ],
            [
                'name' => 'Elastic Black Belt',
                'description' => 'BEST CHOICE FOR SPROTS & TRAVEL: This plastic belts for men makes with lightweight and wear-resisting nylon material that has a strong evaporation of sweat, more comfortable and breathable, feel more flexible, EASY TO DRY IN AIR FOR OUTDOOR SPORTS. 
                    ◆The buckle does not contain any metal components, free to pass through airport security check for travel.',
                'price' => 87.99,
                'image' => 'belt2.jpg',  'category_id' => 2,
                'stock' => 55
            ],
            [
                'name' => 'Dikies Mens Vest',
                'description' => ' Brand: Dikies,
                    Comfortable cotton t-shirt',
                'price' => 207,
                'image' => 'vest1.jpg',
                'stock' => 20,  'category_id' => 2,
                'brand' => 'Dickies'
            ],
            [
                'name' => 'Womens Skinny Jeans',
                'description' => 'Brand: Tommy Hilfiger,
                    Button closure and zip
                    Belt loops
                    Ankle length',
                'price' => 106.99,
                'image' => 'jeans4.jpg',
                'stock' => 90,  'category_id' => 2,
                'brand' => 'Tommy Hilfiger'
            ],
        ];

        $bookProducts = [

            [
                'name' => 'Recipe Book',
                'description' => '"This cleverly designed first book in the Cook in a Book series lets children help make pancakes, but theres no need to break out the aprons: all the cooking is accomplished by pulling tabs... Turning wheels... And flipping cardboard pancakes."―Publishers Weekly, Starred Rewiew *',
                'price' => 25.99,
                'image' => 'recipe.jpg',  'category_id' => 4,
                'stock' => 10
            ],
            [
                'name' => 'Alphabet Kids Book',
                'description' => 'Xavier Deneux trained as a set designer and since then has applied a lifelong passion for child development to more than 100 books, including the TouchThinkLearn series. He lives in Paris, France.',
                'price' => 129.99,
                'image' => 'alphabet.jpg',  'category_id' => 4,
                'stock' => 90
            ],
            [
                'name' => 'BellyButton Kids Book',
                'description' => 'Karen Katz has written and illustrated more than fifty picture books and novelty books including the bestselling Where Is Babys Belly Button? ',
                'price' => 89.99,
                'image' => 'belly.jpg',  'category_id' => 4,
                'stock' => 35
            ],
            [
                'name' => 'Julia Rothman Book',
                'description' => 'This special collectors edition set features Julia Rothmans best-selling Anatomy series, plus 10 framable prints not available anywhere else. In Farm Anatomy, Nature Anatomy, and Food Anatomy, 
                    Rothmans whimsical eye and curious nature shed an imaginative light on all the parts and pieces of our world. These beautiful, brimming pages are guaranteed to delight and inform readers and explorers of all ages.',
                'price' => 67.99,
                'image' => 'julia.jpg',  'category_id' => 4,
                'stock' => 15
            ],
            [
                'name' => 'Big Book Blue',
                'description' => 'Yuval Zommer graduated from the Royal College of Art with an MA in Illustration. He worked as a creative director at leading advertising agencies before becoming the author and illustrator of highly acclaimed non-fiction.',
                'price' => 96.99,
                'image' => 'bigblue.jpg',  'category_id' => 4,
                'stock' => 60
            ],
            [
                'name' => 'Code a Sandcastle Book',
                'description' => 'During the day, Josh Funk writes C++, Java Code, and Python scripts as a software engineer, which hes been doing for the last 20 years. In his spare time he uses ABCs, drinks Java coffee, and writes picture book manuscripts such as Lady Pancake & Sir French Toast, 
                    The Case of the Stinky Stench, Dear Dragon, and more. Josh graduated Suma cum Laude from the UMass Amherst Commonwealth College with a degree in Computer Science. He is a board member of The Writers Loft in Sherborn, MA and the co-coordinator of the 2017 New England Regional SCBWI Conference.',
                'price' => 99.99,
                'image' => 'codecastle.jpg',  'category_id' => 4,
                'stock' => 12
            ],
            [
                'name' => 'WellPlated Recipe Book',
                'description' => 'Erin Clarke is the creator of the popular recipe website Well Plated by Erin. She has established herself as a go-to resource for nourishing yet delicious meals that are easy enough for an average weeknight, special enough for a date night, 
                    and comforting enough to earn picky-eater approval. She is an active runner and a healthy-living enthusiast, and has been known to show up on friends doorsteps with a pan of enchiladas in one hand and a pitcher of sangria in the other.',
                'price' => 127.99,
                'image' => 'recipe2.jpg',  'category_id' => 4,
                'stock' => 67
            ],
            [
                'name' => 'AirFryer Recipe Book',
                'description' => 'I bet you crave simple, no-fuss air fryer recipes! Thats why I decided to create the best air fryer cookbook with
                    600 delicious & easy meals that',
                'price' => 147.99,
                'image' => 'airfryerbook.jpg',  'category_id' => 4,
                'stock' => 25
            ],
            [
                'name' => 'Baking Recipe Book',
                'description' => 'Legendary baker Rose Levy Beranbaum is back with her most extensive "bible" yet. With all-new recipes for the best cakes, pies, tarts, cookies, candies, pastries, breads, and more, this magnum opus draws from Roses passion and expertise in every category of baking. ',
                'price' => 161.99,
                'image' => 'bakingbible.jpg',  'category_id' => 4,
                'stock' => 115
            ],
            [
                'name' => 'Tartine Recipe Book',
                'description' => 'This brilliantly revisited and beautifully rephotographed book is a totally updated edition of a go-to classic for home and professional bakers—from one of the most acclaimed and inspiring bakeries in the world. 
                    Tartine offers more than 50 new recipes that capture the invention and, above all, deliciousness that Tartine is known for—including their most requested recipe, the Morning Bun.',
                'price' => 170.99,
                'image' => 'tartine.jpg',  'category_id' => 4,
                'stock' => 25
            ],

        ];

        $electronicsProducts = [

            [
                'name' => 'HP Envy Laptop',
                'description' => '
                    Brand	HP
                    Model name	HP ENVY X360
                    Screen size	15.6 Inches
                    Colour	Nightfall black
                    Hard disk size	1 TB
                    Installed RAM memory size	32 GB',
                'price' => 4270.99,
                'image' => 'laptop1.jpg',
                'stock' => 25, 'category_id' => 1,
                'brand' => 'HP'
            ],
            [
                'name' => 'Jeans',
                'description' => 'Stylish blue jeans',
                'price' => 49.99,
                'image' => 'jeans.png',
                'stock' => 16, 'category_id' => 1,
                'brand' => 'Tommy Hilfiger'
            ],
            [
                'name' => 'Hp Envy Laptop',
                'description' => '
                    Brand	HP
                    Model name	ENVY x360 Convertible 15-eu1026nr
                    Screen size	15 Inches
                    Colour	Nightfall black aluminum
                    Hard disk size	512 GB
                    CPU model	AMD Ryzen 7
                    Installed RAM memory size	8 GB
                    Operating system	Windows 11 Home
                    Special features	Operating system: Windows 11 Home, Processor: AMD Ryzen 7 5825U, Display: 15.6-inch diagonal, FHD (1920 x 1080), multitouch-enabled, IPS, edge-to-edge glass, micro-edge, Internal storage: 512 GB PCIe NVMe M.2 SSD, Memory: 8 GB DDR4-3200 MHz RAM (2 X 4 GB)Operating system: Windows 11 Home, Processor: AMD Ryzen 7 5825U, Display: 15.6-inch diagonal, FHD (1920 x 1080), multitouch-enabled, IPS, ed.',
                'price' => 3420.99,
                'image' => 'laptop2.jpg',
                'stock' => 25, 'category_id' => 1,
                'brand' => 'HP'
            ],
            [
                'name' => 'Lenovo Tab M10',
                'description' => 'Brand	Lenovo
                    Model name	Tab M10 Plus 3rd Gen
                    Memory storage capacity	32 GB
                    Screen size	10.61 Inches
                    Maximum display resolution	2000 x 1200 Pixels',
                'price' => 1008.99,
                'image' => 'tab1.jpg',
                'stock' => 10, 'category_id' => 1,
                'brand' => 'Lenovo'
            ],
            [
                'name' => 'Lenovo Idea Pad',
                'description' => '
                    Brand	Lenovo
                    Model name	Lenovo Ideapad 1i
                    Screen size	14 Inches
                    Colour	Gray
                    Hard disk size	64 GB
                    CPU model	Celeron
                    Installed RAM memory size	4 GB
                    Operating system	Windows 11
                    Special features	inexpensive budget pc commuter travel writers security safe friendly simple basic fun value midsize listen watch movies music audio school college telecommute fast multi-task ordenador portátil personal asequible thin standard Anti-Glare 250 nitsinexpensive budget pc commuter travel writers security safe friendly simple basic fun value midsize listen watch movies music audio school college te… See more
                    Graphics card description	Integrated',
                'price' => 1098.99,
                'image' => 'laptop3.jpg',
                'stock' => 25, 'category_id' => 1,
                'brand' => 'Lenovo'
            ],
            [
                'name' => 'Dell Inspiron Laptop',
                'description' => 'Brand	Dell
                    Model name	Inspiron
                    Screen size	15.6 Inches
                    Colour	Black
                    Hard disk size	1 TB
                    Installed RAM memory size	16 GB',
                'price' => 3083.99,
                'image' => 'laptop4.jpg',
                'stock' => 20, 'category_id' => 1,
                'brand' => 'Dell'
            ],
            [
                'name' => 'Dell Inspiron Laptop',
                'description' => '
                    Brand	Dell
                    Model name	Inspiron
                    Screen size	15.6 Inches
                    Colour	16GB RAM | 1TB HDD
                    Hard disk size	1 TB
                    CPU model	Celeron
                    Installed RAM memory size	16 GB',
                'price' => 3500.99,
                'image' => 'Laptop5.jpg',
                'stock' => 25, 'category_id' => 1,
                'brand' => 'Dell'
            ],
            [
                'name' => 'Samsung Galaxy Tab',
                'description' => 'Brand	Unknown
                    Model name	Galaxy Tab A8
                    Memory storage capacity	64 GB
                    Screen size	10.5 Inches
                    Maximum display resolution	1920 x 1200 Pixels',
                'price' => 1060.99,
                'image' => 'tab2.jpg',
                'stock' => 25, 'category_id' => 1,
                'brand' => 'Samsung'
            ],
            [
                'name' => 'Samsung Galaxy Phone',
                'description' => '
                    Brand	SAMSUNG
                    Model name	Galaxy A14 LTE
                    Wireless service provider	Unlocked for All Carriers
                    Operating system	Android
                    Cellular technology	LTE
                    Memory storage capacity	128 GB
                    Connectivity technology	Wi-Fi
                    Colour	Black
                    Screen size	6.6 Inches
                    Wireless network technology	LTE',
                'price' => 600.99,
                'image' => 'phone1.jpg',
                'stock' => 90, 'category_id' => 1,
                'brand' => 'Samsung'
            ],
            [
                'name' => 'S22Ultra SamsungGalaxy Phone',
                'description' => '
                    Brand	SAMSUNG
                    Model name	Samsung Galaxy S22 Ultra
                    Wireless service provider	Unlocked for All Carriers
                    Operating system	Android
                    Cellular technology	2G
                    Memory storage capacity	256 GB
                    Connectivity technology	USB
                    Colour	Burgundy
                    Screen size	6.8 Inches
                    Wireless network technology	GSM',
                'price' => 4500.99,
                'image' => 'phone2.jpg',
                'stock' => 25, 'category_id' => 1,
                'brand' => 'Samsung'
            ],

        ];

        $sportsProducts = [
            [
                'name' => 'Running Shoes',
                'description' => 'Comfortable running shoes',
                'price' => 69.99,
                'image' => 'runningshoes.png', 'category_id' => 5,
                'stock' => 51
            ],
            [
                'name' => 'Boots',
                'description' => 'Waterproof boots',
                'price' => 79.99,
                'image' => 'boots.png', 'category_id' => 5,
                'stock' => 24
            ],
            [
                'name' => 'Sneakers',
                'description' => 'Casual sneakers',
                'price' => 59.99,
                'image' => 'sneakers.png', 'category_id' => 5,
                'stock' => 61
            ],
            [
                'name' => 'Flip Flops',
                'description' => 'Beach flip flops',
                'price' => 9.99,
                'image' => 'flipflops.png', 'category_id' => 5,
                'stock' => 654
            ],
            [
                'name' => 'Dress Shoes',
                'description' => 'Formal dress shoes',
                'price' => 89.99,
                'image' => 'dressshoes.png', 'category_id' => 5,
                'stock' => 48
            ],
            [
                'name' => 'Sandals',
                'description' => 'Stylish sandals',
                'price' => 29.99,
                'image' => 'sandals.png', 'category_id' => 5,
                'stock' => 321
            ],
            [
                'name' => 'Loafers',
                'description' => 'Classic leather loafers',
                'price' => 59.99,
                'image' => 'loafers.png', 'category_id' => 5,
                'stock' => 79
            ],
            [
                'name' => 'High Heels',
                'description' => 'Elegant high-heeled shoes',
                'price' => 89.99,
                'image' => 'highheels.png', 'category_id' => 5,
                'stock' => 641
            ],
            [
                'name' => 'Sneaker Boots',
                'description' => 'Stylish sneaker boots',
                'price' => 69.99,
                'image' => 'sneakerboots.png', 'category_id' => 5,
                'stock' => 51
            ],
            [
                'name' => 'Espadrilles',
                'description' => 'Lightweight espadrille shoes',
                'price' => 39.99,
                'image' => 'espadrilles.png', 'category_id' => 5,
                'stock' => 4
            ],
            [
                'name' => 'Mens Athletic Tracksuit',
                'description' => 'COLORS 888 - 2LINESET - (PLEASE ORDER ONE SIZE UP FROM NORMAL) Smooth and shiny material. 2 Side Jacket pockets 3 Pants pockets.
                    COLORS 422 - 477 - (PLEASE ORDER ONE SIZE UP FROM NORMAL) Smooth and shiny material. 2 Zippered side jacket pockets. 2 Zippered pants pockets. (Chest zipper does not work)',
                'price' => 245.99,
                'image' => 'tracksuit.jpg', 'category_id' => 5,
                'stock' => 200,
                'brand' => 'Facitisu'
            ],
            [
                'name' => 'Womens Sweat Tracksuit',
                'description' => 'MATERIA: 60% Cotton + 40% Soft Polyester Velour
                    FASHION: 2 pieces velvet tracksuit sweatsuit set including a hoodie matching a same color velvet sweatpants that make a beauty of coordination which is on trend.',
                'price' => 249.99,
                'image' => 'tracksuit2.jpg', 'category_id' => 5,
                'stock' => 16
            ],
            [
                'name' => 'Adidas Womwns Shoe',
                'description' => 'Colour Name: Ftwr White/Red Zest/Active Pink
                    Lightweight heathered textile upper with polyurethane protective coating
                    Durable Adiwear outsole and putting green-friendly spikeless outsole with Traxion lugs
                    EVA midsole
                    Lightweight and low profile
                    Slightly rounded toe and wider forefoot',
                'price' => 245.99,
                'image' => 'adidas.jpg', 'category_id' => 5,
                'stock' => 22,
                'brand' => 'Adidas'
            ],
            [
                'name' => 'Adidas Mens Shoe',
                'description' => 'Colour Name: Grey Two/Grey Three/Grey One
                    
                    Grey Two/Grey Three/Grey One
                    
                    
                    Core Black/Dark Solid Grey/Glory Blue
                    
                    
                    Ftwr White/Glory Blue/Red
                    Lightweight, stable feel
                    Lace closure
                    Knit and synthetic upper with film overlay
                    Durable Adiwear outsole
                    Flexible Bounce midsole cushioning',
                'price' => 889.99,
                'image' => 'adidas2.jpg', 'category_id' => 5,
                'stock' => 25,
                'brand' => 'Adidas'
            ],
            [
                'name' => 'Yoga Mat Fitness',
                'description' => 'Colour	Green
                    Brand	gaiam
                    Material	Nitrile Butadiene Rubber Foam
                    Product care instructions	Hand Wash Only
                    Product dimensions	72L x 24W x 0.4Th centimetres',
                'price' => 289.99,
                'image' => 'ypgamat.jpg', 'category_id' => 5,
                'stock' => 25
            ],
            [
                'name' => 'Eco Friendly Yogamat',
                'description' => '
                    Colour	Blue
                    Brand	GENERIC
                    Product care instructions	Hand Wash Only',
                'price' => 100.99,
                'image' => 'yogamat2.jpg', 'category_id' => 5,
                'stock' => 25
            ],
            [
                'name' => 'Womens Yoga Pant',
                'description' => 'Machine Wash
                    ATHLIO Womens Yoga Series designed for exploring liberation and the highest self.
                    [Materials] Mixed of polyester & spandex fabric has lightweight, breathability, durability, moisture-wicking properties to resistant sweat.
                    [4-Way Stretch & Shape Retention] It provides for non-see-through, enhanced mobility, and recovery.',
                'price' => 67.99,
                'image' => 'yogapant.jpg', 'category_id' => 5,
                'stock' => 30
            ],
            [
                'name' => 'Sunzel Yoga Pant',
                'description' => ' Brand: Sunzel,
                    [Tummy Control Yoga Pants] The flare legging is ideal for yoga and gym workouts. The yoga pant provides tummy control, sculpts your legs and accentuates your waistline.
                    [High Quality Fabric] The legging is made of 75% nylon and 25% spandex fabric which is buttery soft, stretchy, non-see through and ultra-light. It gives you proper and weightless support.
                    [Crossover Waistband] The flare legging is designed with crossover waistband and V seam that gives you a flattering fit.
                    [Inseam Length] Designed with 30-inch inseam regular length, the flare legging is supportive enough and gives you an elegant look.
                    [All Day Comfort] The flare legging is suitable for every casual occasion and provides you all day comfort.',
                'price' => 248.99,
                'image' => 'yogapant3.jpg', 'category_id' => 5,
                'stock' => 25,
                'brand' => 'Sunzel'
            ],
            [
                'name' => 'Vintage Basketball',
                'description' => 'Brand	AND1
                    Material	Faux Leather
                    Colour	Tan
                    Age range (description)	Adult
                    Sport	Basketball
                    Item diameter	9.5 Inches
                    Number of items	1',
                'price' => 119.99,
                'image' => 'busketball.jpg', 'category_id' => 5,
                'stock' => 85
            ],
            [
                'name' => 'Wilson Busket Ball',
                'description' => '
                    Brand	WILSON
                    Material	PureFeel Cover
                    Colour	Blue Grey
                    Age range (description)	Adult
                    Item weight	1 Pounds
                    Sport	Basketball',
                'price' => 207.99,
                'image' => 'busketball2.jpg', 'category_id' => 5,
                'stock' => 89,
                'brand' => 'Wilson'
            ],

        ];

        $kitchenProducts = [
            [
                'name' => 'Bamboo Silverware Organizer',
                'description' => 'Storage Space Problems Solved - Our bamboo kitchen drawer organizer for large utensils and flatware is an absolute necessity for kitchens everywhere. 
                    Beautiful bamboo, quality craftsmanship, and expandability means our utensil drawer organizer isnt just your average silverware   holder. Features nine main compartments for spoons, knives, forks, and serving utensils with two additional compartments for larger kitchen tools.',
                'price' => 192.99,
                'image' => 'bambooorganizer.jpg', 'category_id' => 3,
                'stock' => 85
            ],
            [
                'name' => 'Dish Drying Organizer',
                'description' => 'SPACE SAVING: Top Tier places up to 17 pcs plates; down tier places up to 18 pcs bowls; holder for cutting board and utensil. Great space saving solution.',
                'price' => 226.99,
                'image' => 'dishorganizer.jpg', 'category_id' => 3,
                'stock' => 96
            ],
            [
                'name' => 'Gibson Elite Dinnerware',
                'description' => 'Dappled with light dashes, darkened rims and a reactive glaze, the Gibson Elite Matisse 16 Piece Dinnerware Set will create an aura of elegance in your dining room.
                    This gorgeous Cobalt Blue dinnerware set includes four dinner plates, four dessert plates, four cereal bowls and four dinner bowls.',
                'price' => 456.99,
                'image' => 'blackdinner.jpg', 'category_id' => 3,
                'stock' => 29
            ],
            [
                'name' => 'Corelle Dinnerware',
                'description' => 'Ultra hygienic, non porous and easy to clean plates and bowls.
                    Plates and bowls are lightweight and easy to handle.
                    Plates and bowls stack compactly, taking up half the space of ceramic dishes.
                    Dishwasher and microwave safe.',
                'price' => 432.99,
                'image' => 'corelledinner.jpg', 'category_id' => 3,
                'stock' => 100
            ],
            [
                'name' => 'Black Dinnerware',
                'description' => '16 Piece dinnerware set stoneware is hip, cool and trendy. Especially in a fashionable Black Matte. These sets of dishes make a statement.
                    Dinnerware Service for 4 includes 4 round dinner plates, 4 Salad plates, 4 bowls and 4 Handled mugs. All with a post modern lipped rim design.',
                'price' => 314.99,
                'image' => 'dinner.jpg', 'category_id' => 3,
                'stock' => 25
            ],
            [
                'name' => 'Blue Mug',
                'description' => 'Closeable Press-In Lid slides shut to tame splashes and trap temps, then slides open wide enough for easy drinking and reusable straws
                    Soft Touch Exterior is easy and comfy to hold
                    TempShield double-wall vacuum insulation protects temperature for hours
                    Made with 18/8 pro-grade stainless steel to ensure pure taste and no flavor transfer',
                'price' => 99.99,
                'image' => 'bluemug.jpg', 'category_id' => 3,
                'stock' => 85
            ],
            [
                'name' => 'Pink Coffee Mug',
                'description' => 'GOOD FOR SEVERAL OCCASIONS: Our coffee cup is very unique and makes it a nice and useful Moms gift for coffee lovers or tea drinkers. It can be given as a present for many special occasions such as Valentines Day, Mothers Day, Birthdays, Special gift basket, 
                    Thanksgiving, Christmas, Secret Santa and much more.',
                'price' => 67.99,
                'image' => 'coffeemug.jpg', 'category_id' => 3,
                'stock' => 25
            ],
            [
                'name' => 'Delta Children Sofa',
                'description' => 'CONVERTIBLE 2-IN-1 DESIGN: This flip-open sofa converts to a lounger/sleeper| Ideal for reading, relaxing, playing or sleeping, your child will enjoy this couch with siblings/friends | Recommended for ages 18 monthsplus | Comfortably fits 3 small children and 2 older children',
                'price' => 311.99,
                'image' => 'pinksofa.jpg', 'category_id' => 3,
                'stock' => 40
            ],
            [
                'name' => 'Sofa Cover',
                'description' => '【High quality fabric】: 94% polyester 6% spandex, skin soft touch jacquard material, comfortable and wrinkle resistant. Sofa slipcovers are suitable for most types of sofas.',
                'price' => 163.99,
                'image' => 'sofacover.jpg', 'category_id' => 3,
                'stock' => 200
            ],
            [
                'name' => 'Brown Chair Sofa',
                'description' => 'HIGH QUALITY: Elegant quilted texture, thick microfiber, colorfast.Water resistant,Two color options. Double the use.
                    DIMENSIONS: Sofa Cover: Fit seat width 25.5 in, Please Measure Before Purchasing; See Measuring Guide in Photos',
                'price' => 151.99,
                'image' => 'chairsofa.jpg', 'category_id' => 3,
                'stock' => 85
            ],

        ];


        // Insert clothing products data


        // Insert shoe products data



        $products = array_merge($clothingProducts, $sportsProducts, $bookProducts, $kitchenProducts, $electronicsProducts);

        $startTime = Carbon::now();
        $i = 0;
        foreach ($products as $product) {
            //$product['image' = '/images/products/' . implode(',', $product['image']);

            $product['created_at'] = $startTime->addSeconds($i * 10); // Increment timestamp by 10 seconds

            $product['shop_id'] = rand(1,5);
            $product['image'] = '/images/products/' . $product['image'];
            Product::create($product);
            $i++;
        }

        $counter = 0;
        $statuses = ['to_ship', 'to_recieve', 'completed', 'cancel', 'refund'];
        $paymentMethods = ['cod', 'bank', 'paypal'];
        $deliveryMethods = ['Deliver', 'Self_Collect'];

        foreach ($products as $product) {
            $counter++;

            // Calculate the index based on the counter
            $statusIndex = ($counter - 1) % count($statuses);
            $paymentMethodIndex = ($counter - 1) % count($paymentMethods);
            $deliveryMethodIndex = ($counter - 1) % count($deliveryMethods);

            Order::create([
                'user_id' => $counter % 2 === 0 ? 1 : 2,
                'product_id' => $counter,
                'product_price' => $product['price'],
                'product_quantity' => rand(1, 20),
                'status' => $statuses[$statusIndex],
                'payment_method' => $paymentMethods[$paymentMethodIndex],
                'delivery_method' => $deliveryMethods[$deliveryMethodIndex],
            ]);
        }
    }
}
