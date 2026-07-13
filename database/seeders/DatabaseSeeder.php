<?php
namespace Database\Seeders;
use App\Models\Product;use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder{public function run(){Product::query()->delete();$items=[
['Creator Cloud Pro','حزمة المبدع الاحترافية','A complete creative suite for design, photography, video editing and publishing.','حزمة إبداعية متكاملة للتصميم والتصوير وتحرير الفيديو والنشر.','Creative','إبداع',24,39,4.9,'BEST SELLER','الأكثر مبيعًا','violet','✦'],
['Focus OS Lifetime','فوكس OS مدى الحياة','A calm command center for planning projects, habits, notes and deep work.','مركز هادئ لتخطيط المشاريع والعادات والملاحظات والعمل العميق.','Productivity','إنتاجية',18,29,4.8,'LIFETIME','مدى الحياة','cyan','⌁'],
['Shield VPN Ultra','شيلد VPN ألترا','Fast, private and borderless browsing on every device you own.','تصفح سريع وخاص بلا حدود على جميع أجهزتك.','Security','حماية',12,25,4.9,'VERIFIED','موثّق','blue','◇'],
['Motion Kit 4K','حزمة موشن 4K','Cinematic transitions, titles and effects built for modern video editors.','انتقالات وعناوين ومؤثرات سينمائية لمحرري الفيديو العصريين.','Creative','إبداع',16,31,4.7,'NEW','جديد','pink','◉'],
['Office Flow 365','أوفيس فلو 365','Documents, planning, presentations and collaboration in one productive suite.','المستندات والتخطيط والعروض والتعاون في حزمة إنتاجية واحدة.','Productivity','إنتاجية',20,35,4.8,'POPULAR','شائع','amber','▦'],
['CodePilot Studio','كود بايلوت ستوديو','An intelligent coding workspace that helps you plan, refactor and ship faster.','مساحة برمجة ذكية تساعدك على التخطيط والتحسين والإنجاز بسرعة.','Development','تطوير',28,45,5.0,'AI POWERED','مدعوم بالذكاء الاصطناعي','green','⌘']];foreach($items as$i)Product::create(array_combine(['name','name_ar','description','description_ar','category','category_ar','price','old_price','rating','badge','badge_ar','color','icon'],$i));}}

