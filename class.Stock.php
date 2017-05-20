<?php
class Stock{
  function __construct(){
    $this->name = ucwords($this->random_name(rand(1,3)));
    $this->symbol = strtoupper(substr($this->name, 0, rand(3, 4)));
    $this->price = number_format((rand(1, 500)/3), 2);
    $this->price_history = array($this->price);
    $this->active = true;
    $this->change = 0;
  }

  function update_price($gain=true){
    if(!$this->active) return $this->price;

    $this->change = number_format((rand(0,9)+(rand(0,99)/100) * ($gain ? 1 : -1)), 2);
    $this->price = number_format(($this->price + $this->change), 2);
    $this->price_history[] = $this->price;
    $this->active = $this->price > 0;

    return $this->price;
  }

  function random_name($name_word_length=2){
    $word_list = Array(
     'above','accident','act','activist','actor','add','administration','adviser','against','age','agency','aggression','agriculture','aid','aim','air','airplanes','airport','all','ally','almost','always','ambassador','amend','ammunition','among','amount','anarchy','ancient','anger','animal','anniversary','announce','another','answer','any','apologize','appeal','appear','appoint','approved','area','argue','arms','army','around','arrest','arrive','art','artillery','as','ash','ask','assist','astronaut','asylum','atmosphere','atom','attack','attempt','attend','automobile','autumn','awake','award','away',
         'back','bad','balance','ball','balloon','ballot','ban','bank','bar','base','battle','beach','beat','beauty','because','become','bed','beg','begin','behind','believe','bell','belong','below','best','betray','better','between','big','bill','bird','bite','bitter','black','blame','blanket','bleed','blind','block','blood','blow','blue','boat','body','boil','bomb','bone','book','border','born','borrow','both','bottle','bottom','box','boy','brain','brave','bread','break','breathe','bridge','brief','bright','bring','broadcast','brother','brown','build','bullet','burn','burst','bury','bus','business','busy',
         'cabinet','call','calm','camera','campaign','can','cancel','cancer','candidate','cannon','capital','capture','car','care','careful','carry','case','cat','catch','cattle','cause','ceasefire','celebrate','cell','center','century','ceremony','chairman','champion','chance','change','charge','chase','cheat','check','cheer','chemicals','chieg','child','choose','church','circle','citizen','city','civil','civilian','clash','clean','clear','climb','clock','close','cloth','clothes','cloud','coal','coalition','coast','coffee','cold','collect','colony','color','comedy','command','comment','committee','common','communicate','company','compete','complete','compromise','computer','concern','condemn','condition','conference','confirm','conflict','congratulate','congress','connect','conservative','consider','contain','continent','continue','control','convention','cook','cool','cooperate','copy','correct','cost','costitution','cotton','count','country','court','cover','cow','coward','crash','create','creature','credit','crew','crime','criminal','crisis','criticize','crops','cross','crowd','cruel','crush','cry','culture','cure','current','custom','cut',
         'damage','dance','danger','dark','date','daughter','day','deal','debate','decide','declare','deep','defeat','defend','deficit','degree','delay','delegate','demand','demonstrate','denounce','deny','depend','deplore','deploy','describe','desert','design','desire','destroy','details','develop','device','different','difficult','dig','dinner','diplomat','direct','direction','dirty','disappear','disarm','discover','discuss','disease','dismiss','dispute','dissident','distance','distant','dive','divide','doctor','document','dollar','door','down','draft','dream','drink','drive','drown','dry','during','dust','duty',
         'each','early','earn','earth','earthquake','ease','east','easy','eat','economy','edge','educate','effect','effort','egg','either','elect','electricity','electron','element','embassy','emergency','emotion','employ','empty','end','enemy','energy','enforce','engine','engineer','enjoy','enough','enter','eqipment','equal','escape','especially','establish','even','event','evidence','evil','evironment','exact','examine','example','excellent','exchange','excite','excuse','execute','exile','exist','expand','expect','expel','experiment','expert','explain','explode','explore','export','express','extend','extra','extreme',
         'face','fact','factory','fail','fair','fall','family','famous','fanatic','far','farm','fast','fat','fear','feast','federal','feed','feel','few','field','fierce','fight','fill','film','final','find','fine','finish','fire','firm','first','fish','fix','flag','flat','flee','float','flood','floor','flow','flowers','fluid','fly','foal','fog','follow','food','fool','foot','force','foreign','forget','forgive','form','former','forward','free','freeze','fresh','friend','frighten','front','fruit','fuel','funeral','furious','future',
         'gain','game','gas','gather','general','gentle','gift','girl','give','glass','goal','gold','good','goods','govern','grift','grain','grass','gray','great','green','grind','ground','group','grow','guarantee','guard','guerilla','guide','guilty','gun','gin','gumption','gangly',
         'hair','half','halt','hang','happen','happy','harbor','hard','harm','hat','hate','head','headquarters','health','hear','heart','heat','heavy','helicopter','help','hero','hide','high','hijack','hill','history','hit','hold','hole','holiday','holy','home','honest','honor','hope','horrible','horse','hospital','hostage','hostile','hostilities','hot','hotel','hour','house','how','however','huge','human','humor','hunger','hunt','hurry','hurt','husband',
         'ice','idea','illegal','imagine','immediate','import','important','improve','incident','incite','include','increase','independent','industry','inflation','influence','inform','injure','innocent','insane','insect','inspect','instead','instrument','insult','intelligence','intense','interest','interfere','international','intervene','invade','invent','invest','investigate','invite','involve','iron','island','issue',
         'jail','jewel','job','join','joint','joke','judge','jump','jungle','jury','just','joust','jack','jangly','jazzy','jet','jerky','jawless','jejune','jittery','joyless','joyful','jumpy','jilted','jerky','jovial','jaunty','jocund','jocose','juxtaposed','juvenile','jumbled','jowly',
         'keep','kick','kind','kiss','knife','know','knot','kangaroo','kiln','kilt','knight','kite','kernel','knack','klutz','kinky','kooky','king','kenetic','kindly','kindle','kitted','kissed','keen','knobby','knighted','key','kosher','knotty','knavish','kitschy',
         'labor','laboratory','lack','lake','land','language','large','last','late','laugh','launch','law','lead','leak','learn','leave','left','legal','lend','less','let','letter','level','lie','life','light','lightning','like','limit','line','link','liquids','list','listen','little','live','load','local','lonely','long','look','lose','loud','love','low','loyal','luck',
         'machine','mad','mail','main','major','majority','make','maps','march','mark','marker','mass','material','may','mayor','mean','measure','meat','medicine','meet','melt','member','memorial','memory','mercenary','mercy','message','metal','method','microscope','middle','militant','military','milk','mind','mine','mineral','minister','minor','minority','minute','miss','missile','missing','mistake','mix','mob','moderate','modern','money','month','moon','more','morning','most','mother','motion','mountain','mourn','move','much','music','must','mystery',
         'naked','name','nation','navy','near','necessary','negotiate','neither','nerve','neutral','never','new','news','next','nice','night','noise','nominate','noon','normal','north','note','nothing','nowhere','nuclear','number','nurse','naive','nautical','negligible','nethermost',
         'obey','object','observe','occupy','ocean','offensive','offer','officer','official','often','oil','old','once','only','open','operate','opinion','oppose','opposite','oppress','orbit','orchestra','order','organize','other','overthrow','obsolescent','offshore','odious','oblong','offbeat','olympic',
         'pain','paint','palace','pamphlet','pan','paper','parachute','parade','pardon','parent','parliament','part','party','pass','passenger','passport','past','path','pay','peace','people','percent','perfect','perhaps','period','permanent','permit','person','physics','piano','picture','piece','pilot','pipe','pirate','place','planet','plant','play','please','plenty','plot','poem','point','poison','police','policy','politics','pollute','poor','popular','population','port','position','possess','possible','postpone','pour','power','praise','pray','pregnant','prepare','present','president','press','pressure','prevent','price','priest','prison','private','prize','probably','problem','produce','professor','program','progress','project','promise','propaganda','property','propose','protect','protest','proud','prove','provide','public','publication','publish','pull','pump','punish','purchase','pure','purpose',
         'question','quick','quiet','quilt','quail','quaint','quality','quest','qualified','quenched','queasy','quizzical','quantified','qualm','query','quieter','questionable','quotable','quenchless','quiver','quote','quack','quake','quartz','quarrelsome','questioning','quelled',
         'rabbi','race','radar','radiation','radio','raid','railroad','rain','raise','rapid','rare','rate','reach','read','ready','real','realistic','reason','reasonable','rebel','receive','recent','recession','recognize','record','red','reduce','reform','refugee','refuse','regret','relations','release','remain','remember','remove','repair','repeat','report','repress','request','rescue','resign','resolution','responsible','rest','restrain','restrict','result','retire','return','revolt','rice','rich','ride','right','riot','rise','river','road','rock','rocket','roll','room','root','rope','rough','round','rub','rubber','ruin','rule','run',
         'sabotage','sacrifice','safe','sail','salt','same','satellite','satisfy','save','say','school','science','scream','sea','search','season','seat','second','secret','security','see','seek','seem','seize','self','sense','sentence','separate','series','serious','sermon','settle','several','severe','shake','shape','share','sharp','shell','shine','ship','shock','shoe','shoot','short','should','shout','show','shrink','shut','sick','side','sign','signal','silence','silver','similar','simple','since','sing','sink','situation','skeleton','skill','skull','sky','slave','sleep','slide','slow','small','smash','smile','smoke','smooth','snow','social','soft','soldier','solid','solve','some','soon','sorry','sort','sound','south','space','speak','special','speed','spend','spill','spilt','spirit','split','sports','spread','spring','spy','stab','stamp','stand','star','start','starve','state','station','statue','stay','steal','steam','steel','step','stick','still','stomach','stone','stop','store','storm','story','stove','straight','strange','street','stretch','strike','strong','struggle','stubborn','study','stupid','submarine','substance','substitute','subversion','succeed','such','sudden','suffer','sugar','summer','sun','supervise','supply','support','suppose','suppress','sure','surplus','surprise','surrender','surround','survive','suspect','suspend','swallow','swear','sweet','swim','sympathy','system',
         'take','talk','tall','tank','target','task','taste','tax','teach','team','tear','tears','technical','telephone','telescope','television','tell','temperature','temporary','tense','term','terrible','territory','terror','test','textiles','thank','that','theater','thick','thin','thing','think','third','threaten','through','throw','tie','time','tired','tissue','today','together','tomorrow','tonight','tool','top','torture','touch','toward','town','trade','tradition','tragic','train','traitor','transport','trap','travel','treason','treasure','treat','treaty','tree','trial','tribe','trick','trip','troops','trouble','truck','trust','turn',
         'under','understand','unite','universe','university','unless','until','up','urge','urgent','usual','valley','value','vehicle','version','veto','vicious','victim','victory','village','violate','violence','violin','virus','visit','voice','volcano','vote','voyage','verbose','vincible','visualized',
         'wages','wait','walk','wall','want','warm','warn','wash','waste','watch','water','wave','way','weak','wealth','weapon','wear','weather','weigh','welcome','well','west','wet','wheat','wheel','white','wide','wife','wild','will','willing','win','wind','window','wire','wise','wish','withdraw','without','woman','wonder','wood','woods','word','work','world','worry','worse','wound','wreck','write','wrong',
         'year','yellow','yesterday','young','yeti','yogurt','yelp','yard','yearning','you','yucky','yonder','younger','youthful','yuppy','yin','yang','yak','yokai',
         'zebra','zoo', 'zing','zipper','zit','zepplin','zapper','zany','zombie','zonked','zinc','zenith','zesty','zippy','zoological','zygote','zigzag','zebra'
    );
    $name = "";
    for($i=0; $i<$name_word_length; $i++){
      $name .= $word_list[rand(0, sizeof($word_list))].' ';
    }
    return rtrim($name);
  }
}
?>
