<?php

namespace App\Utility;

class WoWZoneUtility
{

    public const ZONE_DUNMOROGH = 1;
    public const ZONE_LONGSHORE = 2;
    public const ZONE_BADLANDS = 3;
    public const ZONE_BLASTEDLANDS = 4;
    public const ZONE_BLACKWATERCOVE = 7;
    public const ZONE_SWAMPOFSORROWS = 8;
    public const ZONE_NORTHSHIREVALLEY = 9;
    public const ZONE_DUSKWOOD = 10;
    public const ZONE_WETLANDS = 11;
    public const ZONE_ELWYNNFOREST = 12;
    public const ZONE_THEWORLDTREE = 13;
    public const ZONE_DUROTAR = 14;
    public const ZONE_DUSTWALLOWMARSH = 15;
    public const ZONE_AZSHARA = 16;
    public const ZONE_THEBARRENS = 17;
    public const ZONE_CRYSTALLAKE = 18;
    public const ZONE_ZULGURUB = 1977;
    public const ZONE_MOONBROOK = 20;
    public const ZONE_KULTIRAS = 21;
    public const ZONE_PROGRAMMERISLE = 22;
    public const ZONE_NORTHSHIRERIVER = 23;
    public const ZONE_NORTHSHIREABBEY = 24;
    public const ZONE_BLACKROCKMOUNTAIN = 1445;
    public const ZONE_LIGHTHOUSE = 26;
    public const ZONE_WESTERNPLAGUELANDS = 28;
    public const ZONE_NINE = 30;
    public const ZONE_THECEMETARY = 32;
    public const ZONE_STRANGLETHORNVALE = 33;
    public const ZONE_ECHORIDGEMINE = 34;
    public const ZONE_BOOTYBAY = 35;
    public const ZONE_ALTERACMOUNTAINS = 36;
    public const ZONE_LAKENAZFERITI = 37;
    public const ZONE_LOCHMODAN = 38;
    public const ZONE_WESTFALL = 40;
    public const ZONE_DEADWINDPASS = 41;
    public const ZONE_DARKSHIRE = 42;
    public const ZONE_WILDSHORE = 43;
    public const ZONE_REDRIDGEMOUNTAINS = 44;
    public const ZONE_ARATHIHIGHLANDS = 45;
    public const ZONE_BURNINGSTEPPES = 46;
    public const ZONE_THEHINTERLANDS = 47;
    public const ZONE_DEADMANSHOLE = 49;
    public const ZONE_SEARINGGORGE = 51;
    public const ZONE_THIEVESCAMP = 53;
    public const ZONE_JASPERLODEMINE = 54;
    public const ZONE_VALLEYOFHEROES = 1617;
    public const ZONE_HEROESVIGIL = 56;
    public const ZONE_FARGODEEPMINE = 57;
    public const ZONE_NORTHSHIREVINEYARDS = 59;
    public const ZONE_FORESTSEDGE = 60;
    public const ZONE_THUNDERFALLS = 61;
    public const ZONE_BRACKWELLPUMPKINPATCH = 62;
    public const ZONE_THESTONEFIELDFARM = 63;
    public const ZONE_THEMACLUREVINEYARDS = 64;
    public const ZONE_LAKEEVERSTILL = 68;
    public const ZONE_LAKESHIRE = 69;
    public const ZONE_STONEWATCH = 70;
    public const ZONE_STONEWATCHFALLS = 71;
    public const ZONE_THEDARKPORTAL = 3706;
    public const ZONE_THETAINTEDSCAR = 73;
    public const ZONE_POOLOFTEARS = 74;
    public const ZONE_STONARD = 75;
    public const ZONE_FALLOWSANCTUARY = 76;
    public const ZONE_ANVILMAR = 77;
    public const ZONE_STORMWINDMOUNTAINS = 80;
    public const ZONE_TIRISFALGLADES = 85;
    public const ZONE_STONECAIRNLAKE = 86;
    public const ZONE_GOLDSHIRE = 87;
    public const ZONE_EASTVALELOGGINGCAMP = 88;
    public const ZONE_MIRRORLAKEORCHARD = 89;
    public const ZONE_TOWEROFAZORA = 91;
    public const ZONE_MIRRORLAKE = 92;
    public const ZONE_VULGOLOGREMOUND = 93;
    public const ZONE_RAVENHILL = 94;
    public const ZONE_REDRIDGECANYONS = 95;
    public const ZONE_TOWEROFILGALAR = 96;
    public const ZONE_ALTHERSMILL = 97;
    public const ZONE_RETHBANCAVERNS = 98;
    public const ZONE_REBELCAMP = 99;
    public const ZONE_NESINGWARYSEXPEDITION = 100;
    public const ZONE_KURZENSCOMPOUND = 101;
    public const ZONE_RUINSOFZULKUNDA = 102;
    public const ZONE_RUINSOFZULMAMWE = 103;
    public const ZONE_THEVILEREEF = 104;
    public const ZONE_MOSHOGGOGREMOUND = 105;
    public const ZONE_THESTOCKPILE = 106;
    public const ZONE_SALDEANSFARM = 107;
    public const ZONE_SENTINELHILL = 108;
    public const ZONE_FURLBROWSPUMPKINFARM = 109;
    public const ZONE_JANGOLODEMINE = 111;
    public const ZONE_GOLDCOASTQUARRY = 113;
    public const ZONE_WESTFALLLIGHTHOUSE = 115;
    public const ZONE_MISTYVALLEY = 116;
    public const ZONE_GROMGOLBASECAMP = 117;
    public const ZONE_WHELGARSEXCAVATIONSITE = 118;
    public const ZONE_WESTBROOKGARRISON = 120;
    public const ZONE_TRANQUILGARDENSCEMETERY = 121;
    public const ZONE_ZUULDAIARUINS = 122;
    public const ZONE_BALLALRUINS = 123;
    public const ZONE_KALAIRUINS = 125;
    public const ZONE_TKASHIRUINS = 126;
    public const ZONE_BALIAMAHRUINS = 127;
    public const ZONE_ZIATAJAIRUINS = 128;
    public const ZONE_MIZJAHRUINS = 129;
    public const ZONE_SILVERPINEFOREST = 130;
    public const ZONE_KHARANOS = 131;
    public const ZONE_COLDRIDGEVALLEY = 132;
    public const ZONE_GNOMEREGAN = 721;
    public const ZONE_GOLBOLARQUARRY = 134;
    public const ZONE_FROSTMANEHOLD = 135;
    public const ZONE_THEGRIZZLEDDEN = 136;
    public const ZONE_BREWNALLVILLAGE = 137;
    public const ZONE_MISTYPINEREFUGE = 138;
    public const ZONE_EASTERNPLAGUELANDS = 139;
    public const ZONE_TELDRASSIL = 141;
    public const ZONE_IRONBANDSEXCAVATIONSITE = 142;
    public const ZONE_MOGROSHSTRONGHOLD = 143;
    public const ZONE_THELSAMAR = 144;
    public const ZONE_ALGAZGATE = 145;
    public const ZONE_STONEWROUGHTDAM = 146;
    public const ZONE_THEFARSTRIDERLODGE = 147;
    public const ZONE_DARKSHORE = 148;
    public const ZONE_SILVERSTREAMMINE = 149;
    public const ZONE_MENETHILHARBOR = 150;
    public const ZONE_DESIGNERISLAND = 151;
    public const ZONE_THEBULWARK = 813;
    public const ZONE_RUINSOFLORDAERON = 153;
    public const ZONE_DEATHKNELL = 154;
    public const ZONE_NIGHTWEBSHOLLOW = 155;
    public const ZONE_SOLLIDENFARMSTEAD = 156;
    public const ZONE_AGAMANDMILLS = 157;
    public const ZONE_AGAMANDFAMILYCRYPT = 158;
    public const ZONE_BRILL = 159;
    public const ZONE_WHISPERINGGARDENS = 160;
    public const ZONE_TERRACEOFREPOSE = 161;
    public const ZONE_BRIGHTWATERLAKE = 162;
    public const ZONE_GUNTHERSRETREAT = 163;
    public const ZONE_GARRENSHAUNT = 164;
    public const ZONE_BALNIRFARMSTEAD = 165;
    public const ZONE_COLDHEARTHMANOR = 166;
    public const ZONE_CRUSADEROUTPOST = 167;
    public const ZONE_THENORTHCOAST = 168;
    public const ZONE_WHISPERINGSHORE = 169;
    public const ZONE_LORDAMERELAKE = 1339;
    public const ZONE_FENRISISLE = 172;
    public const ZONE_FAOLSREST = 173;
    public const ZONE_DOLANAAR = 186;
    public const ZONE_SHADOWGLEN = 188;
    public const ZONE_STEELGRILLSDEPOT = 189;
    public const ZONE_HEARTHGLEN = 190;
    public const ZONE_NORTHRIDGELUMBERCAMP = 192;
    public const ZONE_RUINSOFANDORHAL = 193;
    public const ZONE_SCHOOLOFNECROMANCY = 195;
    public const ZONE_UTHERSTOMB = 196;
    public const ZONE_SORROWHILL = 197;
    public const ZONE_THEWEEPINGCAVE = 198;
    public const ZONE_FELSTONEFIELD = 199;
    public const ZONE_DALSONSTEARS = 200;
    public const ZONE_GAHRRONSWITHERING = 201;
    public const ZONE_THEWRITHINGHAUNT = 202;
    public const ZONE_MARDENHOLDEKEEP = 203;
    public const ZONE_PYREWOODVILLAGE = 204;
    public const ZONE_DUNMODR = 205;
    public const ZONE_THEGREATSEA = 2399;
    public const ZONE_UNUSEDIRONCLADCOVE = 208;
    public const ZONE_SHADOWFANGKEEP = 236;
    public const ZONE_ICEFLOWLAKE = 211;
    public const ZONE_HELMSBEDLAKE = 212;
    public const ZONE_DEEPELEMMINE = 213;
    public const ZONE_MULGORE = 215;
    public const ZONE_ALEXSTONFARMSTEAD = 219;
    public const ZONE_REDCLOUDMESA = 220;
    public const ZONE_CAMPNARACHE = 221;
    public const ZONE_BLOODHOOFVILLAGE = 222;
    public const ZONE_STONEBULLLAKE = 223;
    public const ZONE_RAVAGEDCARAVAN = 224;
    public const ZONE_REDROCKS = 225;
    public const ZONE_THESKITTERINGDARK = 226;
    public const ZONE_VALGANSFIELD = 227;
    public const ZONE_THESEPULCHER = 228;
    public const ZONE_OLSENSFARTHING = 229;
    public const ZONE_THEGREYMANEWALL = 230;
    public const ZONE_BERENSPERIL = 231;
    public const ZONE_THEDAWNINGISLES = 232;
    public const ZONE_AMBERMILL = 233;
    public const ZONE_FENRISKEEP = 235;
    public const ZONE_THEDECREPITFERRY = 237;
    public const ZONE_MALDENSORCHARD = 238;
    public const ZONE_THEIVARPATCH = 239;
    public const ZONE_THEDEADFIELD = 240;
    public const ZONE_THEROTTINGORCHARD = 241;
    public const ZONE_BRIGHTWOODGROVE = 242;
    public const ZONE_FORLORNROWE = 243;
    public const ZONE_THEWHIPPLEESTATE = 244;
    public const ZONE_THEYORGENFARMSTEAD = 245;
    public const ZONE_THECAULDRON = 246;
    public const ZONE_GRIMESILTDIGSITE = 247;
    public const ZONE_DREADMAULROCK = 249;
    public const ZONE_RUINSOFTHAURISSAN = 250;
    public const ZONE_FLAMECREST = 251;
    public const ZONE_BLACKROCKSTRONGHOLD = 252;
    public const ZONE_THEPILLAROFASH = 253;
    public const ZONE_ALTAROFSTORMS = 1441;
    public const ZONE_ALDRASSIL = 256;
    public const ZONE_SHADOWTHREADCAVE = 257;
    public const ZONE_FELROCK = 258;
    public const ZONE_LAKEALAMETH = 259;
    public const ZONE_STARBREEZEVILLAGE = 260;
    public const ZONE_GNARLPINEHOLD = 261;
    public const ZONE_BANETHILBARROWDEN = 262;
    public const ZONE_THECLEFT = 263;
    public const ZONE_THEORACLEGLADE = 264;
    public const ZONE_WELLSPRINGRIVER = 265;
    public const ZONE_WELLSPRINGLAKE = 266;
    public const ZONE_HILLSBRADFOOTHILLS = 267;
    public const ZONE_AZSHARACRATER = 268;
    public const ZONE_DUNALGAZ = 837;
    public const ZONE_SOUTHSHORE = 2369;
    public const ZONE_TARRENMILL = 2368;
    public const ZONE_DURNHOLDEKEEP = 2370;
    public const ZONE_STONEWROUGHTPASS = 2838;
    public const ZONE_THEFOOTHILLCAVERNS = 277;
    public const ZONE_LORDAMEREINTERNMENTCAMP = 278;
    public const ZONE_DALARAN = 279;
    public const ZONE_STRAHNBRAD = 280;
    public const ZONE_RUINSOFALTERAC = 281;
    public const ZONE_CRUSHRIDGEHOLD = 282;
    public const ZONE_SLAUGHTERHOLLOW = 283;
    public const ZONE_THEUPLANDS = 284;
    public const ZONE_SOUTHPOINTTOWER = 2376;
    public const ZONE_HILLSBRADFIELDS = 2372;
    public const ZONE_HILLSBRAD = 287;
    public const ZONE_AZURELODEMINE = 2379;
    public const ZONE_NETHANDERSTEAD = 2374;
    public const ZONE_DUNGAROK = 2371;
    public const ZONE_THORADINSWALL = 2377;
    public const ZONE_EASTERNSTRAND = 2373;
    public const ZONE_WESTERNSTRAND = 2378;
    public const ZONE_JAGUEROISLE = 297;
    public const ZONE_BARADINBAY = 298;
    public const ZONE_MENETHILBAY = 299;
    public const ZONE_MISTYREEDSTRAND = 300;
    public const ZONE_THESAVAGECOAST = 301;
    public const ZONE_THECRYSTALSHORE = 302;
    public const ZONE_SHELLBEACH = 303;
    public const ZONE_NORTHTIDESRUN = 305;
    public const ZONE_SOUTHTIDESRUN = 306;
    public const ZONE_THEOVERLOOKCLIFFS = 307;
    public const ZONE_THEFORBIDDINGSEA = 2403;
    public const ZONE_IRONBEARDSTOMB = 309;
    public const ZONE_CRYSTALVEINMINE = 310;
    public const ZONE_RUINSOFABORAZ = 311;
    public const ZONE_JANEIROSPOINT = 312;
    public const ZONE_NORTHFOLDMANOR = 313;
    public const ZONE_GOSHEKFARM = 314;
    public const ZONE_DABYRIESFARMSTEAD = 315;
    public const ZONE_BOULDERFISTHALL = 316;
    public const ZONE_WITHERBARKVILLAGE = 317;
    public const ZONE_DRYWHISKERGORGE = 318;
    public const ZONE_REFUGEPOINTE = 320;
    public const ZONE_HAMMERFALL = 321;
    public const ZONE_BLACKWATERSHIPWRECKS = 322;
    public const ZONE_OBREENSCAMP = 323;
    public const ZONE_STROMGARDEKEEP = 324;
    public const ZONE_THETOWEROFARATHOR = 325;
    public const ZONE_THESANCTUM = 326;
    public const ZONE_FALDIRSCOVE = 327;
    public const ZONE_THEDROWNEDREEF = 328;
    public const ZONE_THANDOLSPAN = 881;
    public const ZONE_ASHENVALE = 331;
    public const ZONE_CIRCLEOFEASTBINDING = 333;
    public const ZONE_CIRCLEOFWESTBINDING = 334;
    public const ZONE_CIRCLEOFINNERBINDING = 335;
    public const ZONE_CIRCLEOFOUTERBINDING = 336;
    public const ZONE_APOCRYPHANSREST = 337;
    public const ZONE_ANGORFORTRESS = 338;
    public const ZONE_LETHLORRAVINE = 339;
    public const ZONE_KARGATH = 340;
    public const ZONE_CAMPKOSH = 341;
    public const ZONE_CAMPBOFF = 342;
    public const ZONE_CAMPWURG = 343;
    public const ZONE_CAMPCAGG = 344;
    public const ZONE_AGMONDSEND = 345;
    public const ZONE_HAMMERTOESDIGSITE = 346;
    public const ZONE_DUSTBELCHGROTTO = 347;
    public const ZONE_AERIEPEAK = 348;
    public const ZONE_WILDHAMMERKEEP = 349;
    public const ZONE_QUELDANILLODGE = 350;
    public const ZONE_SKULKROCK = 351;
    public const ZONE_ZUNWATHA = 352;
    public const ZONE_SHADRAALOR = 353;
    public const ZONE_JINTHAALOR = 354;
    public const ZONE_THEALTAROFZUL = 355;
    public const ZONE_SERADANE = 356;
    public const ZONE_FERALAS = 357;
    public const ZONE_BRAMBLEBLADERAVINE = 358;
    public const ZONE_BAELMODAN = 359;
    public const ZONE_THEVENTURECOMINE = 360;
    public const ZONE_FELWOOD = 361;
    public const ZONE_RAZORHILL = 362;
    public const ZONE_VALLEYOFTRIALS = 363;
    public const ZONE_THEDEN = 364;
    public const ZONE_BURNINGBLADECOVEN = 365;
    public const ZONE_KOLKARCRAG = 366;
    public const ZONE_SENJINVILLAGE = 367;
    public const ZONE_ECHOISLES = 368;
    public const ZONE_THUNDERRIDGE = 369;
    public const ZONE_DRYGULCHRAVINE = 370;
    public const ZONE_DUSTWINDCAVE = 371;
    public const ZONE_TIRAGARDEKEEP = 372;
    public const ZONE_SCUTTLECOAST = 373;
    public const ZONE_BLADEFISTBAY = 374;
    public const ZONE_DEADEYESHORE = 375;
    public const ZONE_SOUTHFURYRIVER = 879;
    public const ZONE_CAMPTAURAJO = 378;
    public const ZONE_FARWATCHPOST = 379;
    public const ZONE_THECROSSROADS = 380;
    public const ZONE_BOULDERLODEMINE = 381;
    public const ZONE_THESLUDGEFEN = 382;
    public const ZONE_THEDRYHILLS = 383;
    public const ZONE_DREADMISTPEAK = 384;
    public const ZONE_NORTHWATCHHOLD = 385;
    public const ZONE_THEFORGOTTENPOOLS = 386;
    public const ZONE_LUSHWATEROASIS = 387;
    public const ZONE_THESTAGNANTOASIS = 388;
    public const ZONE_FIELDOFGIANTS = 390;
    public const ZONE_THEMERCHANTCOAST = 391;
    public const ZONE_RATCHET = 392;
    public const ZONE_DARKSPEARSTRAND = 393;
    public const ZONE_WINTERHOOFWATERWELL = 396;
    public const ZONE_THUNDERHORNWATERWELL = 397;
    public const ZONE_WILDMANEWATERWELL = 398;
    public const ZONE_SKYLINERIDGE = 399;
    public const ZONE_THOUSANDNEEDLES = 400;
    public const ZONE_THETIDUSSTAIR = 401;
    public const ZONE_SHADYRESTINN = 403;
    public const ZONE_BAELDUNDIGSITE = 404;
    public const ZONE_DESOLACE = 405;
    public const ZONE_STONETALONMOUNTAINS = 406;
    public const ZONE_GILLIJIMSISLE = 408;
    public const ZONE_ISLANDOFDOCTORLAPIDIS = 409;
    public const ZONE_RAZORWINDCANYON = 410;
    public const ZONE_BATHRANSHAUNT = 411;
    public const ZONE_THERUINSOFORDILARAN = 412;
    public const ZONE_MAESTRASPOST = 413;
    public const ZONE_THEZORAMSTRAND = 414;
    public const ZONE_ASTRANAAR = 415;
    public const ZONE_THESHRINEOFAESSINA = 416;
    public const ZONE_FIRESCARSHRINE = 417;
    public const ZONE_THERUINSOFSTARDUST = 418;
    public const ZONE_THEHOWLINGVALE = 419;
    public const ZONE_SILVERWINDREFUGE = 420;
    public const ZONE_MYSTRALLAKE = 421;
    public const ZONE_FALLENSKYLAKE = 422;
    public const ZONE_IRISLAKE = 424;
    public const ZONE_MOONWELL = 425;
    public const ZONE_RAYNEWOODRETREAT = 426;
    public const ZONE_THESHADYNOOK = 427;
    public const ZONE_NIGHTRUN = 428;
    public const ZONE_XAVIAN = 429;
    public const ZONE_SATYRNAAR = 430;
    public const ZONE_SPLINTERTREEPOST = 431;
    public const ZONE_THEDORDANILBARROWDEN = 432;
    public const ZONE_FALFARRENRIVER = 433;
    public const ZONE_FELFIREHILL = 434;
    public const ZONE_DEMONFALLCANYON = 435;
    public const ZONE_DEMONFALLRIDGE = 436;
    public const ZONE_WARSONGLUMBERCAMP = 437;
    public const ZONE_BOUGHSHADOW = 438;
    public const ZONE_THESHIMMERINGFLATS = 439;
    public const ZONE_TANARIS = 440;
    public const ZONE_LAKEFALATHIM = 441;
    public const ZONE_AUBERDINE = 442;
    public const ZONE_RUINSOFMATHYSTRA = 443;
    public const ZONE_TOWEROFALTHALAXX = 444;
    public const ZONE_CLIFFSPRINGFALLS = 445;
    public const ZONE_BASHALARAN = 446;
    public const ZONE_AMETHARAN = 447;
    public const ZONE_GROVEOFTHEANCIENTS = 448;
    public const ZONE_THEMASTERSGLAIVE = 449;
    public const ZONE_REMTRAVELSEXCAVATION = 450;
    public const ZONE_MISTSEDGE = 452;
    public const ZONE_THELONGWASH = 453;
    public const ZONE_WILDBENDRIVER = 454;
    public const ZONE_BLACKWOODDEN = 455;
    public const ZONE_CLIFFSPRINGRIVER = 456;
    public const ZONE_THEVEILEDSEA = 3479;
    public const ZONE_GOLDROAD = 458;
    public const ZONE_SCARLETWATCHPOST = 459;
    public const ZONE_SUNROCKRETREAT = 460;
    public const ZONE_WINDSHEARCRAG = 461;
    public const ZONE_CRAGPOOLLAKE = 463;
    public const ZONE_MIRKFALLONLAKE = 464;
    public const ZONE_THECHARREDVALE = 465;
    public const ZONE_VALLEYOFTHEBLOODFURIES = 466;
    public const ZONE_STONETALONPEAK = 467;
    public const ZONE_THETALONDEN = 468;
    public const ZONE_GREATWOODVALE = 469;
    public const ZONE_BRAVEWINDMESA = 471;
    public const ZONE_FIRESTONEMESA = 472;
    public const ZONE_MANTLEROCK = 473;
    public const ZONE_RUINSOFJUBUWAL = 477;
    public const ZONE_POOLSOFARLITHRIEN = 478;
    public const ZONE_THERUSTMAULDIGSITE = 479;
    public const ZONE_CAMPETHOK = 480;
    public const ZONE_SPLITHOOFCRAG = 481;
    public const ZONE_HIGHPERCH = 482;
    public const ZONE_THESCREECHINGCANYON = 483;
    public const ZONE_FREEWINDPOST = 484;
    public const ZONE_THEGREATLIFT = 1718;
    public const ZONE_GALAKHOLD = 486;
    public const ZONE_ROGUEFEATHERDEN = 487;
    public const ZONE_THEWEATHEREDNOOK = 488;
    public const ZONE_THALANAAR = 489;
    public const ZONE_UNGOROCRATER = 490;
    public const ZONE_RAZORFENKRAUL = 1717;
    public const ZONE_RAVENHILLCEMETERY = 492;
    public const ZONE_MOONGLADE = 493;
    public const ZONE_BRACKENWALLVILLAGE = 496;
    public const ZONE_SWAMPLIGHTMANOR = 497;
    public const ZONE_BLOODFENBURROW = 498;
    public const ZONE_DARKMISTCAVERN = 499;
    public const ZONE_MOGGLEPOINT = 500;
    public const ZONE_BEEZILSWRECK = 501;
    public const ZONE_WITCHHILL = 502;
    public const ZONE_SENTRYPOINT = 503;
    public const ZONE_NORTHPOINTTOWER = 504;
    public const ZONE_WESTPOINTTOWER = 505;
    public const ZONE_LOSTPOINT = 506;
    public const ZONE_BLUEFEN = 507;
    public const ZONE_STONEMAULRUINS = 508;
    public const ZONE_THEDENOFFLAME = 509;
    public const ZONE_THEDRAGONMURK = 510;
    public const ZONE_WYRMBOG = 511;
    public const ZONE_ONYXIASLAIR = 2159;
    public const ZONE_THERAMOREISLE = 513;
    public const ZONE_FOOTHOLDCITADEL = 514;
    public const ZONE_IRONCLADPRISON = 515;
    public const ZONE_DUSTWALLOWBAY = 516;
    public const ZONE_TIDEFURYCOVE = 517;
    public const ZONE_DREADMURKSHORE = 518;
    public const ZONE_ADDLESSTEAD = 536;
    public const ZONE_FIREPLUMERIDGE = 537;
    public const ZONE_LAKKARITARPITS = 538;
    public const ZONE_TERRORRUN = 539;
    public const ZONE_THESLITHERINGSCAR = 540;
    public const ZONE_MARSHALSREFUGE = 541;
    public const ZONE_FUNGALROCK = 542;
    public const ZONE_GOLAKKAHOTSPRINGS = 543;
    public const ZONE_THELOCH = 556;
    public const ZONE_BEGGARSHAUNT = 576;
    public const ZONE_KODOGRAVEYARD = 596;
    public const ZONE_GHOSTWALKERPOST = 597;
    public const ZONE_SARTHERISSTRAND = 598;
    public const ZONE_THUNDERAXEFORTRESS = 599;
    public const ZONE_BOLGANSHOLE = 600;
    public const ZONE_MANNOROCCOVEN = 602;
    public const ZONE_SARGERON = 603;
    public const ZONE_MAGRAMVILLAGE = 604;
    public const ZONE_GELKISVILLAGE = 606;
    public const ZONE_VALLEYOFSPEARS = 607;
    public const ZONE_NIJELSPOINT = 608;
    public const ZONE_KOLKARVILLAGE = 609;
    public const ZONE_HYJAL = 616;
    public const ZONE_WINTERSPRING = 618;
    public const ZONE_BLACKWOLFRIVER = 636;
    public const ZONE_KODOROCK = 637;
    public const ZONE_HIDDENPATH = 638;
    public const ZONE_SPIRITROCK = 639;
    public const ZONE_SHRINEOFTHEDORMANTFLAME = 640;
    public const ZONE_LAKEELUNEARA = 656;
    public const ZONE_THEHARBORAGE = 657;
    public const ZONE_OUTLAND = 676;
    public const ZONE_CRAFTSMENSTERRACE = 1659;
    public const ZONE_TRADESMENSTERRACE = 1662;
    public const ZONE_THETEMPLEGARDENS = 1661;
    public const ZONE_TEMPLEOFELUNE = 699;
    public const ZONE_CENARIONENCLAVE = 1658;
    public const ZONE_WARRIORSTERRACE = 1660;
    public const ZONE_RUTTHERANVILLAGE = 702;
    public const ZONE_IRONBANDSCOMPOUND = 716;
    public const ZONE_THESTOCKADE = 717;
    public const ZONE_WAILINGCAVERNS = 718;
    public const ZONE_BLACKFATHOMDEEPS = 2797;
    public const ZONE_FRAYISLAND = 720;
    public const ZONE_RAZORFENDOWNS = 1316;
    public const ZONE_BANETHILHOLLOW = 736;
    public const ZONE_SCARLETMONASTERY = 796;
    public const ZONE_JERODSLANDING = 797;
    public const ZONE_RIDGEPOINTTOWER = 798;
    public const ZONE_THEDARKENEDBANK = 799;
    public const ZONE_COLDRIDGEPASS = 800;
    public const ZONE_CHILLBREEZEVALLEY = 801;
    public const ZONE_SHIMMERRIDGE = 802;
    public const ZONE_AMBERSTILLRANCH = 803;
    public const ZONE_THETUNDRIDHILLS = 804;
    public const ZONE_SOUTHGATEPASS = 839;
    public const ZONE_SOUTHGATEOUTPOST = 806;
    public const ZONE_NORTHGATEPASS = 838;
    public const ZONE_NORTHGATEOUTPOST = 808;
    public const ZONE_GATESOFIRONFORGE = 809;
    public const ZONE_STILLWATERPOND = 810;
    public const ZONE_NIGHTMAREVALE = 811;
    public const ZONE_VENOMWEBVALE = 812;
    public const ZONE_RAZORMANEGROUNDS = 816;
    public const ZONE_SKULLROCK = 817;
    public const ZONE_PALEMANEROCK = 818;
    public const ZONE_WINDFURYRIDGE = 819;
    public const ZONE_THEGOLDENPLAINS = 820;
    public const ZONE_THEROLLINGPLAINS = 821;
    public const ZONE_TWILIGHTGROVE = 856;
    public const ZONE_GMISLAND = 876;
    public const ZONE_PURGATIONISLE = 896;
    public const ZONE_THEJANSENSTEAD = 916;
    public const ZONE_THEDEADACRE = 917;
    public const ZONE_THEMOLSENFARM = 918;
    public const ZONE_STENDELSPOND = 919;
    public const ZONE_THEDAGGERHILLS = 920;
    public const ZONE_DEMONTSPLACE = 921;
    public const ZONE_THEDUSTPLAINS = 922;
    public const ZONE_STONESPLINTERVALLEY = 923;
    public const ZONE_VALLEYOFKINGS = 924;
    public const ZONE_ALGAZSTATION = 925;
    public const ZONE_BUCKLEBREEFARM = 926;
    public const ZONE_THESHININGSTRAND = 927;
    public const ZONE_NORTHTIDESHOLLOW = 928;
    public const ZONE_GRIZZLEPAWRIDGE = 936;
    public const ZONE_THEVERDANTFIELDS = 956;
    public const ZONE_GADGETZAN = 976;
    public const ZONE_STEAMWHEEDLEPORT = 977;
    public const ZONE_ZULFARRAK = 1176;
    public const ZONE_SANDSORROWWATCH = 979;
    public const ZONE_THISTLESHRUBVALLEY = 980;
    public const ZONE_THEGAPINGCHASM = 981;
    public const ZONE_THENOXIOUSLAIR = 982;
    public const ZONE_DUNEMAULCOMPOUND = 983;
    public const ZONE_EASTMOONRUINS = 984;
    public const ZONE_WATERSPRINGFIELD = 985;
    public const ZONE_ZALASHJISDEN = 986;
    public const ZONE_LANDSENDBEACH = 987;
    public const ZONE_WAVESTRIDERBEACH = 988;
    public const ZONE_ULDUM = 989;
    public const ZONE_VALLEYOFTHEWATCHERS = 990;
    public const ZONE_GUNSTANSPOST = 991;
    public const ZONE_SOUTHMOONRUINS = 992;
    public const ZONE_RENDERSCAMP = 996;
    public const ZONE_RENDERSVALLEY = 997;
    public const ZONE_RENDERSROCK = 998;
    public const ZONE_STONEWATCHTOWER = 999;
    public const ZONE_GALARDELLVALLEY = 1000;
    public const ZONE_LAKERIDGEHIGHWAY = 1001;
    public const ZONE_THREECORNERS = 1002;
    public const ZONE_DIREFORGEHILL = 1016;
    public const ZONE_RAPTORRIDGE = 1017;
    public const ZONE_BLACKCHANNELMARSH = 1018;
    public const ZONE_THEGREENBELT = 1025;
    public const ZONE_MOSSHIDEFEN = 1020;
    public const ZONE_THELGENROCK = 1021;
    public const ZONE_BLUEGILLMARSH = 1022;
    public const ZONE_SALTSPRAYGLEN = 1023;
    public const ZONE_SUNDOWNMARSH = 1024;
    public const ZONE_ANGERFANGENCAMPMENT = 1036;
    public const ZONE_GRIMBATOL = 1037;
    public const ZONE_DRAGONMAWGATES = 1038;
    public const ZONE_THELOSTFLEET = 1039;
    public const ZONE_DARROWHILL = 2375;
    public const ZONE_WEBWINDERPATH = 1076;
    public const ZONE_THEHUSHEDBANK = 1097;
    public const ZONE_MANORMISTMANTLE = 1098;
    public const ZONE_CAMPMOJACHE = 1099;
    public const ZONE_GRIMTOTEMCOMPOUND = 1100;
    public const ZONE_THEWRITHINGDEEP = 1101;
    public const ZONE_WILDWINDLAKE = 1102;
    public const ZONE_GORDUNNIOUTPOST = 1103;
    public const ZONE_MOKGORDUN = 1104;
    public const ZONE_FERALSCARVALE = 1105;
    public const ZONE_FRAYFEATHERHIGHLANDS = 1106;
    public const ZONE_IDLEWINDLAKE = 1107;
    public const ZONE_THEFORGOTTENCOAST = 1108;
    public const ZONE_EASTPILLAR = 1109;
    public const ZONE_WESTPILLAR = 1110;
    public const ZONE_DREAMBOUGH = 1111;
    public const ZONE_JADEMIRLAKE = 1112;
    public const ZONE_ONEIROS = 1113;
    public const ZONE_RUINSOFRAVENWIND = 1114;
    public const ZONE_RAGESCARHOLD = 1115;
    public const ZONE_FEATHERMOONSTRONGHOLD = 1116;
    public const ZONE_RUINSOFSOLARSAL = 1117;
    public const ZONE_THETWINCOLOSSALS = 1119;
    public const ZONE_SARDORISLE = 1120;
    public const ZONE_ISLEOFDREAD = 1121;
    public const ZONE_HIGHWILDERNESS = 1136;
    public const ZONE_LOWERWILDS = 1137;
    public const ZONE_SOUTHERNBARRENS = 1156;
    public const ZONE_SOUTHERNGOLDROAD = 1157;
    public const ZONE_TIMBERMAWHOLD = 1769;
    public const ZONE_VANNDIRENCAMPMENT = 1217;
    public const ZONE_LEGASHENCAMPMENT = 1219;
    public const ZONE_THALASSIANBASECAMP = 1220;
    public const ZONE_RUINSOFELDARATH = 1221;
    public const ZONE_HETAERASCLUTCH = 1222;
    public const ZONE_TEMPLEOFZINMALOR = 1223;
    public const ZONE_BEARSHEAD = 1224;
    public const ZONE_URSOLAN = 1225;
    public const ZONE_TEMPLEOFARKKORAN = 1226;
    public const ZONE_BAYOFSTORMS = 1227;
    public const ZONE_THESHATTEREDSTRAND = 1228;
    public const ZONE_TOWEROFELDARA = 1229;
    public const ZONE_JAGGEDREEF = 1230;
    public const ZONE_SOUTHRIDGEBEACH = 1231;
    public const ZONE_RAVENCRESTMONUMENT = 1232;
    public const ZONE_FORLORNRIDGE = 1233;
    public const ZONE_LAKEMENNAR = 1234;
    public const ZONE_SHADOWSONGSHRINE = 1235;
    public const ZONE_HALDARRENCAMPMENT = 1236;
    public const ZONE_VALORMOK = 1237;
    public const ZONE_THERUINEDREACHES = 1256;
    public const ZONE_THETALONDEEPPATH = 1277;
    public const ZONE_ROCKTUSKFARM = 1296;
    public const ZONE_JAGGEDSWINEFARM = 1297;
    public const ZONE_LOSTRIGGERCOVE = 1336;
    public const ZONE_ULDAMAN = 1517;
    public const ZONE_GALLOWSCORNER = 1357;
    public const ZONE_SILITHUS = 1377;
    public const ZONE_EMERALDFOREST = 1397;
    public const ZONE_SUNKENTEMPLE = 1417;
    public const ZONE_DREADMAULHOLD = 1437;
    public const ZONE_NETHERGARDEKEEP = 1438;
    public const ZONE_DREADMAULPOST = 1439;
    public const ZONE_SERPENTSCOIL = 1440;
    public const ZONE_FIREWATCHRIDGE = 1442;
    public const ZONE_THESLAGPIT = 1443;
    public const ZONE_THESEAOFCINDERS = 1444;
    public const ZONE_THORIUMPOINT = 1446;
    public const ZONE_GARRISONARMORY = 1457;
    public const ZONE_THETEMPLEOFATALHAKKAR = 1477;
    public const ZONE_UNDERCITY = 1497;
    public const ZONE_NOTUSEDDEADMINES = 1518;
    public const ZONE_STORMWINDCITY = 1519;
    public const ZONE_IRONFORGE = 1537;
    public const ZONE_SPLITHOOFHOLD = 1557;
    public const ZONE_THECAPEOFSTRANGLETHORN = 1577;
    public const ZONE_SOUTHERNSAVAGECOAST = 1578;
    public const ZONE_UNUSEDTHEDEADMINES002 = 1579;
    public const ZONE_UNUSEDIRONCLADCOVE003 = 1580;
    public const ZONE_THEDEADMINES = 1581;
    public const ZONE_IRONCLADCOVE = 1582;
    public const ZONE_BLACKROCKSPIRE = 1583;
    public const ZONE_BLACKROCKDEPTHS = 1584;
    public const ZONE_RAPTORGROUNDSUNUSED = 1597;
    public const ZONE_GROLDOMFARMUNUSED = 1598;
    public const ZONE_MORSHANBASECAMP = 1599;
    public const ZONE_HONORSSTANDUNUSED = 1600;
    public const ZONE_BLACKTHORNRIDGEUNUSED = 1601;
    public const ZONE_BRAMBLESCARUNUSED = 1602;
    public const ZONE_AGAMAGORUNUSED = 1603;
    public const ZONE_ORGRIMMAR = 1637;
    public const ZONE_THUNDERBLUFF = 1638;
    public const ZONE_ELDERRISE = 1639;
    public const ZONE_SPIRITRISE = 1640;
    public const ZONE_HUNTERRISE = 1641;
    public const ZONE_DARNASSUS = 1657;
    public const ZONE_GAVINSNAZE = 1677;
    public const ZONE_SOFERASNAZE = 1678;
    public const ZONE_CORRAHNSDAGGER = 1679;
    public const ZONE_THEHEADLAND = 1680;
    public const ZONE_MISTYSHORE = 1681;
    public const ZONE_DANDREDSFOLD = 1682;
    public const ZONE_GROWLESSCAVE = 1683;
    public const ZONE_CHILLWINDPOINT = 1684;
    public const ZONE_RAPTORGROUNDS = 1697;
    public const ZONE_BRAMBLESCAR = 1698;
    public const ZONE_THORNHILL = 1699;
    public const ZONE_AGAMAGOR = 1700;
    public const ZONE_BLACKTHORNRIDGE = 1701;
    public const ZONE_HONORSSTAND = 1702;
    public const ZONE_THEMORSHANRAMPART = 1703;
    public const ZONE_GROLDOMFARM = 1704;
    public const ZONE_MISTVALEVALLEY = 1737;
    public const ZONE_NEKMANIWELLSPRING = 1738;
    public const ZONE_BLOODSAILCOMPOUND = 1739;
    public const ZONE_VENTURECOBASECAMP = 1740;
    public const ZONE_GURUBASHIARENA = 1741;
    public const ZONE_SPIRITDEN = 1742;
    public const ZONE_THECRIMSONVEIL = 1757;
    public const ZONE_THERIPTIDE = 1758;
    public const ZONE_THEDAMSELSLUCK = 1759;
    public const ZONE_VENTURECOOPERATIONSCENTER = 1760;
    public const ZONE_DEADWOODVILLAGE = 1761;
    public const ZONE_FELPAWVILLAGE = 1762;
    public const ZONE_JAEDENAR = 1763;
    public const ZONE_BLOODVENOMRIVER = 1764;
    public const ZONE_BLOODVENOMFALLS = 1765;
    public const ZONE_SHATTERSCARVALE = 1766;
    public const ZONE_IRONTREEWOODS = 1767;
    public const ZONE_IRONTREECAVERN = 1768;
    public const ZONE_SHADOWHOLD = 1770;
    public const ZONE_SHRINEOFTHEDECEIVER = 1771;
    public const ZONE_ITHARIUSSCAVE = 1777;
    public const ZONE_SORROWMURK = 1778;
    public const ZONE_DRAENILDURVILLAGE = 1779;
    public const ZONE_SPLINTERSPEARJUNCTION = 1780;
    public const ZONE_STAGALBOG = 1797;
    public const ZONE_THESHIFTINGMIRE = 1798;
    public const ZONE_STAGALBOGCAVE = 1817;
    public const ZONE_WITHERBARKCAVERNS = 1837;
    public const ZONE_BOULDERGOR = 1858;
    public const ZONE_VALLEYOFFANGS = 1877;
    public const ZONE_THEDUSTBOWL = 1878;
    public const ZONE_MIRAGEFLATS = 1879;
    public const ZONE_FEATHERBEARDSHOVEL = 1880;
    public const ZONE_SHINDIGGERSCAMP = 1881;
    public const ZONE_PLAGUEMISTRAVINE = 1882;
    public const ZONE_VALORWINDLAKE = 1883;
    public const ZONE_AGOLWATHA = 1884;
    public const ZONE_HIRIWATHA = 1885;
    public const ZONE_THECREEPINGRUIN = 1886;
    public const ZONE_BOGENSLEDGE = 1887;
    public const ZONE_THEMAKERSTERRACE = 1897;
    public const ZONE_DUSTWINDGULCH = 1898;
    public const ZONE_SHAOLWATHA = 1917;
    public const ZONE_NOONSHADERUINS = 1937;
    public const ZONE_BROKENPILLAR = 1938;
    public const ZONE_ABYSSALSANDS = 1939;
    public const ZONE_SOUTHBREAKSHORE = 1940;
    public const ZONE_CAVERNSOFTIME = 2300;
    public const ZONE_THEMARSHLANDS = 1942;
    public const ZONE_IRONSTONEPLATEAU = 1943;
    public const ZONE_BLACKCHARCAVE = 1957;
    public const ZONE_TANNERCAMP = 1958;
    public const ZONE_DUSTFIREVALLEY = 1959;
    public const ZONE_MISTYREEDPOST = 1978;
    public const ZONE_BLOODVENOMPOST = 1997;
    public const ZONE_TALONBRANCHGLADE = 1998;
    public const ZONE_STRATHOLME = 2280;
    public const ZONE_QUELTHALAS = 2037;
    public const ZONE_SCHOLOMANCE = 2057;
    public const ZONE_TWILIGHTVALE = 2077;
    public const ZONE_TWILIGHTSHORE = 2078;
    public const ZONE_ALCAZISLAND = 2079;
    public const ZONE_DARKCLOUDPINNACLE = 2097;
    public const ZONE_DAWNINGWOODCATACOMBS = 2098;
    public const ZONE_STONEWATCHKEEP = 2099;
    public const ZONE_MARAUDON = 2100;
    public const ZONE_STOUTLAGERINN = 2101;
    public const ZONE_THUNDERBREWDISTILLERY = 2102;
    public const ZONE_MENETHILKEEP = 2103;
    public const ZONE_DEEPWATERTAVERN = 2104;
    public const ZONE_SHADOWGRAVE = 2117;
    public const ZONE_BRILLTOWNHALL = 2118;
    public const ZONE_GALLOWSENDTAVERN = 2119;
    public const ZONE_THEPOOLSOFVISION = 2197;
    public const ZONE_DREADMISTDEN = 2138;
    public const ZONE_BAELDUNKEEP = 2157;
    public const ZONE_EMBERSTRIFESDEN = 2158;
    public const ZONE_WINDSHEARMINE = 2160;
    public const ZONE_ROLANDSDOOM = 2161;
    public const ZONE_BATTLERING = 2177;
    public const ZONE_SHADOWBREAKRAVINE = 2198;
    public const ZONE_BROKENSPEARVILLAGE = 2217;
    public const ZONE_WHITEREACHPOST = 2237;
    public const ZONE_GORNIA = 2238;
    public const ZONE_ZANESEYECRATER = 2239;
    public const ZONE_MIRAGERACEWAY = 2240;
    public const ZONE_FROSTSABERROCK = 2241;
    public const ZONE_THEHIDDENGROVE = 2242;
    public const ZONE_TIMBERMAWPOST = 2243;
    public const ZONE_WINTERFALLVILLAGE = 2244;
    public const ZONE_MAZTHORIL = 2245;
    public const ZONE_FROSTFIREHOTSPRINGS = 2246;
    public const ZONE_ICETHISTLEHILLS = 2247;
    public const ZONE_DUNMANDARR = 2248;
    public const ZONE_FROSTWHISPERGORGE = 2249;
    public const ZONE_OWLWINGTHICKET = 2250;
    public const ZONE_LAKEKELTHERIL = 2251;
    public const ZONE_THERUINSOFKELTHERIL = 2252;
    public const ZONE_STARFALLVILLAGE = 2253;
    public const ZONE_BANTHALLOWBARROWDEN = 2254;
    public const ZONE_EVERLOOK = 2255;
    public const ZONE_DARKWHISPERGORGE = 2256;
    public const ZONE_DEEPRUNTRAM = 2257;
    public const ZONE_THEFUNGALVALE = 2258;
    public const ZONE_THEMARRISSTEAD = 2260;
    public const ZONE_THEUNDERCROFT = 2261;
    public const ZONE_DARROWSHIRE = 2262;
    public const ZONE_CROWNGUARDTOWER = 2263;
    public const ZONE_CORINSCROSSING = 2264;
    public const ZONE_SCARLETBASECAMP = 2265;
    public const ZONE_TYRSHAND = 2266;
    public const ZONE_THESCARLETBASILICA = 2267;
    public const ZONE_LIGHTSHOPECHAPEL = 2268;
    public const ZONE_BROWMANMILL = 2269;
    public const ZONE_THENOXIOUSGLADE = 2270;
    public const ZONE_EASTWALLTOWER = 2271;
    public const ZONE_NORTHDALE = 2272;
    public const ZONE_ZULMASHAR = 2273;
    public const ZONE_MAZRAALOR = 2274;
    public const ZONE_NORTHPASSTOWER = 2275;
    public const ZONE_QUELLITHIENLODGE = 2276;
    public const ZONE_PLAGUEWOOD = 2277;
    public const ZONE_SCOURGEHOLD = 2278;
    public const ZONE_DARROWMERELAKE = 2299;
    public const ZONE_CAERDARROW = 2298;
    public const ZONE_THISTLEFURVILLAGE = 2301;
    public const ZONE_THEQUAGMIRE = 2302;
    public const ZONE_WINDBREAKCANYON = 2303;
    public const ZONE_SOUTHSEAS = 2338;
    public const ZONE_RAZORHILLBARRACKS = 2337;
    public const ZONE_BLOODTOOTHCAMP = 2357;
    public const ZONE_FORESTSONG = 2358;
    public const ZONE_GREENPAWVILLAGE = 2359;
    public const ZONE_SILVERWINGOUTPOST = 2360;
    public const ZONE_NIGHTHAVEN = 2361;
    public const ZONE_SHRINEOFREMULOS = 2362;
    public const ZONE_STORMRAGEBARROWDENS = 2363;
    public const ZONE_THEBLACKMORASS = 2366;
    public const ZONE_OLDHILLSBRADFOOTHILLS = 2367;
    public const ZONE_TETHRISARAN = 2404;
    public const ZONE_ETHELRETHOR = 2405;
    public const ZONE_RANAZJARISLE = 2406;
    public const ZONE_KORMEKSHUT = 2407;
    public const ZONE_SHADOWPREYVILLAGE = 2408;
    public const ZONE_BLACKROCKPASS = 2417;
    public const ZONE_MORGANSVIGIL = 2418;
    public const ZONE_SLITHERROCK = 2419;
    public const ZONE_TERRORWINGPATH = 2420;
    public const ZONE_DRACODAR = 2421;
    public const ZONE_RAGEFIRECHASM = 2437;
    public const ZONE_NIGHTSONGWOODS = 2457;
    public const ZONE_MORLOSARAN = 2478;
    public const ZONE_EMERALDSANCTUARY = 2479;
    public const ZONE_JADEFIREGLEN = 2480;
    public const ZONE_RUINSOFCONSTELLAS = 2481;
    public const ZONE_BITTERREACHES = 2497;
    public const ZONE_RISEOFTHEDEFILER = 2517;
    public const ZONE_LARISSPAVILION = 2518;
    public const ZONE_WOODPAWHILLS = 2519;
    public const ZONE_WOODPAWDEN = 2520;
    public const ZONE_VERDANTISRIVER = 2521;
    public const ZONE_RUINSOFISILDIEN = 2522;
    public const ZONE_GRIMTOTEMPOST = 2537;
    public const ZONE_CAMPAPARAJE = 2538;
    public const ZONE_MALAKAJIN = 2539;
    public const ZONE_BOULDERSLIDERAVINE = 2540;
    public const ZONE_SISHIRCANYON = 2541;
    public const ZONE_DIREMAUL = 2577;
    public const ZONE_DEADWINDRAVINE = 2558;
    public const ZONE_DIAMONDHEADRIVER = 2559;
    public const ZONE_ARIDENSCAMP = 2560;
    public const ZONE_THEVICE = 2561;
    public const ZONE_KARAZHAN = 3477;
    public const ZONE_MORGANSPLOT = 2563;
    public const ZONE_ALTERACVALLEY = 2839;
    public const ZONE_SCRABBLESCREWSCAMP = 2617;
    public const ZONE_JADEFIRERUN = 2618;
    public const ZONE_THONDRORILRIVER = 2620;
    public const ZONE_LAKEMERELDAR = 2621;
    public const ZONE_PESTILENTSCAR = 2622;
    public const ZONE_THEINFECTISSCAR = 2623;
    public const ZONE_BLACKWOODLAKE = 2624;
    public const ZONE_EASTWALLGATE = 2625;
    public const ZONE_TERRORWEBTUNNEL = 2626;
    public const ZONE_TERRORDALE = 2627;
    public const ZONE_KARGATHIAKEEP = 2637;
    public const ZONE_VALLEYOFBONES = 3794;
    public const ZONE_BLACKWINGLAIR = 2677;
    public const ZONE_DEADMANSCROSSING = 2697;
    public const ZONE_MOLTENCORE = 2717;
    public const ZONE_THESCARABWALL = 2737;
    public const ZONE_SOUTHWINDVILLAGE = 2738;
    public const ZONE_TWILIGHTBASECAMP = 2739;
    public const ZONE_THECRYSTALVALE = 2740;
    public const ZONE_THESCARABDAIS = 2741;
    public const ZONE_HIVEASHI = 2742;
    public const ZONE_HIVEZORA = 2743;
    public const ZONE_HIVEREGAL = 2744;
    public const ZONE_SHRINEOFTHEFALLENWARRIOR = 2757;
    public const ZONE_THEMASTERSCELLAR = 2837;
    public const ZONE_THERUMBLECAGE = 2857;
    public const ZONE_CHUNKTEST = 2877;
    public const ZONE_ZORAMGAROUTPOST = 2897;
    public const ZONE_HALLOFLEGENDS = 2917;
    public const ZONE_CHAMPIONSHALL = 2918;
    public const ZONE_GROSHGOKCOMPOUND = 2937;
    public const ZONE_SLEEPINGGORGE = 2938;
    public const ZONE_IRONDEEPMINE = 2957;
    public const ZONE_STONEHEARTHOUTPOST = 2958;
    public const ZONE_DUNBALDAR = 2959;
    public const ZONE_ICEWINGPASS = 2960;
    public const ZONE_FROSTWOLFVILLAGE = 2961;
    public const ZONE_TOWERPOINT = 2962;
    public const ZONE_COLDTOOTHMINE = 2963;
    public const ZONE_WINTERAXHOLD = 2964;
    public const ZONE_ICEBLOODGARRISON = 2977;
    public const ZONE_FROSTWOLFKEEP = 2978;
    public const ZONE_TORKRENFARM = 2979;
    public const ZONE_FROSTDAGGERPASS = 3017;
    public const ZONE_IRONSTONECAMP = 3037;
    public const ZONE_WEAZELSCRATER = 3038;
    public const ZONE_TAHONDARUINS = 3039;
    public const ZONE_FIELDOFSTRIFE = 3057;
    public const ZONE_ICEWINGCAVERN = 3058;
    public const ZONE_VALORSREST = 3077;
    public const ZONE_THESWARMINGPILLAR = 3097;
    public const ZONE_TWILIGHTPOST = 3098;
    public const ZONE_TWILIGHTOUTPOST = 3099;
    public const ZONE_RAVAGEDTWILIGHTCAMP = 3100;
    public const ZONE_SHALZARUSLAIR = 3117;
    public const ZONE_TALRENDISPOINT = 3137;
    public const ZONE_RETHRESSSANCTUM = 3138;
    public const ZONE_MOONHORRORDEN = 3139;
    public const ZONE_SCALEBEARDSCAVE = 3140;
    public const ZONE_BOULDERSLIDECAVERN = 3157;
    public const ZONE_WARSONGLABORCAMP = 3177;
    public const ZONE_CHILLWINDCAMP = 3197;
    public const ZONE_THEMAUL = 3237;
    public const ZONE_BONESOFGRAKKAROND = 3257;
    public const ZONE_WARSONGGULCH = 3277;
    public const ZONE_FROSTWOLFGRAVEYARD = 3297;
    public const ZONE_FROSTWOLFPASS = 3298;
    public const ZONE_DUNBALDARPASS = 3299;
    public const ZONE_ICEBLOODGRAVEYARD = 3300;
    public const ZONE_SNOWFALLGRAVEYARD = 3301;
    public const ZONE_STONEHEARTHGRAVEYARD = 3302;
    public const ZONE_STORMPIKEGRAVEYARD = 3303;
    public const ZONE_ICEWINGBUNKER = 3304;
    public const ZONE_STONEHEARTHBUNKER = 3305;
    public const ZONE_WILDPAWRIDGE = 3306;
    public const ZONE_REVANTUSKVILLAGE = 3317;
    public const ZONE_ROCKOFDUROTAN = 3318;
    public const ZONE_SILVERWINGGROVE = 3319;
    public const ZONE_WARSONGLUMBERMILL = 3320;
    public const ZONE_SILVERWINGHOLD = 3321;
    public const ZONE_WILDPAWCAVERN = 3337;
    public const ZONE_THEVEILEDCLEFT = 3338;
    public const ZONE_YOJAMBAISLE = 3357;
    public const ZONE_ARATHIBASIN = 3358;
    public const ZONE_THECOIL = 3377;
    public const ZONE_ALTAROFHIREEK = 3378;
    public const ZONE_SHADRAZAAR = 3379;
    public const ZONE_HAKKARIGROUNDS = 3380;
    public const ZONE_NAZEOFSHIRVALLAH = 3381;
    public const ZONE_TEMPLEOFBETHEKK = 3382;
    public const ZONE_THEBLOODFIREPIT = 3383;
    public const ZONE_ALTAROFTHEBLOODGOD = 3384;
    public const ZONE_ZANZASRISE = 3397;
    public const ZONE_EDGEOFMADNESS = 3398;
    public const ZONE_TROLLBANEHALL = 3417;
    public const ZONE_DEFILERSDEN = 3418;
    public const ZONE_PAGLESPOINTE = 3419;
    public const ZONE_FARM = 3420;
    public const ZONE_BLACKSMITH = 3421;
    public const ZONE_LUMBERMILL = 3422;
    public const ZONE_GOLDMINE = 3423;
    public const ZONE_STABLES = 3424;
    public const ZONE_CENARIONHOLD = 3425;
    public const ZONE_STAGHELMPOINT = 3426;
    public const ZONE_BRONZEBEARDENCAMPMENT = 3427;
    public const ZONE_AHNQIRAJ = 3428;
    public const ZONE_RUINSOFAHNQIRAJ = 3454;
    public const ZONE_EVERSONGWOODS = 3430;
    public const ZONE_SUNSTRIDERISLE = 3431;
    public const ZONE_SHRINEOFDATHREMAR = 3432;
    public const ZONE_GHOSTLANDS = 3433;
    public const ZONE_SCARABTERRACE = 3448;
    public const ZONE_GENERALSTERRACE = 3449;
    public const ZONE_THERESERVOIR = 3450;
    public const ZONE_THEHATCHERY = 3451;
    public const ZONE_THECOMB = 3452;
    public const ZONE_WATCHERSTERRACE = 3453;
    public const ZONE_TWILIGHTSRUN = 3446;
    public const ZONE_ORTELLSHIDEOUT = 3447;
    public const ZONE_THENORTHSEA = 3455;
    public const ZONE_NAXXRAMAS = 3456;
    public const ZONE_GOLDENSTRAND = 3460;
    public const ZONE_SUNSAILANCHORAGE = 3461;
    public const ZONE_FAIRBREEZEVILLAGE = 3462;
    public const ZONE_MAGISTERSGATE = 3463;
    public const ZONE_FARSTRIDERRETREAT = 3464;
    public const ZONE_NORTHSANCTUM = 3465;
    public const ZONE_WESTSANCTUM = 3466;
    public const ZONE_EASTSANCTUM = 3467;
    public const ZONE_SALTHERILSHAVEN = 3468;
    public const ZONE_THURONSLIVERY = 3469;
    public const ZONE_STILLWHISPERPOND = 3470;
    public const ZONE_THELIVINGWOOD = 3471;
    public const ZONE_AZUREBREEZECOAST = 3472;
    public const ZONE_LAKEELRENDAR = 3513;
    public const ZONE_THESCORCHEDGROVE = 3474;
    public const ZONE_ZEBWATHA = 3475;
    public const ZONE_TORWATHA = 3476;
    public const ZONE_GATESOFAHNQIRAJ = 3478;
    public const ZONE_DUSKWITHERGROUNDS = 3480;
    public const ZONE_DUSKWITHERSPIRE = 3481;
    public const ZONE_THEDEADSCAR = 3514;
    public const ZONE_HELLFIREPENINSULA = 3483;
    public const ZONE_THESUNSPIRE = 3484;
    public const ZONE_FALTHRIENACADEMY = 3485;
    public const ZONE_RAVENHOLDTMANOR = 3486;
    public const ZONE_SILVERMOONCITY = 3487;
    public const ZONE_TRANQUILLIEN = 3488;
    public const ZONE_SUNCROWNVILLAGE = 3489;
    public const ZONE_GOLDENMISTVILLAGE = 3490;
    public const ZONE_WINDRUNNERVILLAGE = 3491;
    public const ZONE_WINDRUNNERSPIRE = 3492;
    public const ZONE_SANCTUMOFTHESUN = 3493;
    public const ZONE_SANCTUMOFTHEMOON = 3494;
    public const ZONE_DAWNSTARSPIRE = 3495;
    public const ZONE_FARSTRIDERENCLAVE = 3496;
    public const ZONE_ANDAROTH = 3497;
    public const ZONE_ANTELAS = 3498;
    public const ZONE_ANOWYN = 3499;
    public const ZONE_DEATHOLME = 3500;
    public const ZONE_BLEEDINGZIGGURAT = 3501;
    public const ZONE_HOWLINGZIGGURAT = 3502;
    public const ZONE_SHALANDISISLE = 3503;
    public const ZONE_TORYLESTATE = 3504;
    public const ZONE_UNDERLIGHTMINES = 3505;
    public const ZONE_ANDILIENESTATE = 3506;
    public const ZONE_HATCHETHILLS = 3507;
    public const ZONE_AMANIPASS = 3508;
    public const ZONE_SUNGRAZEPEAK = 3509;
    public const ZONE_AMANICATACOMBS = 3510;
    public const ZONE_TOWEROFTHEDAMNED = 3511;
    public const ZONE_ZEBSORA = 3512;
    public const ZONE_ELRENDARRIVER = 3515;
    public const ZONE_ZEBTELA = 3516;
    public const ZONE_ZEBNOWA = 3517;
    public const ZONE_NAGRAND = 3518;
    public const ZONE_TEROKKARFOREST = 3519;
    public const ZONE_SHADOWMOONVALLEY = 3520;
    public const ZONE_ZANGARMARSH = 3521;
    public const ZONE_BLADESEDGEMOUNTAINS = 3522;
    public const ZONE_NETHERSTORM = 3523;
    public const ZONE_AZUREMYSTISLE = 3524;
    public const ZONE_BLOODMYSTISLE = 3525;
    public const ZONE_AMMENVALE = 3526;
    public const ZONE_CRASHSITE = 3527;
    public const ZONE_SILVERLINELAKE = 3528;
    public const ZONE_NESTLEWOODTHICKET = 3529;
    public const ZONE_SHADOWRIDGE = 3530;
    public const ZONE_SKULKINGROW = 3531;
    public const ZONE_DAWNINGLANE = 3532;
    public const ZONE_RUINSOFSILVERMOON = 3533;
    public const ZONE_FETHSWAY = 3534;
    public const ZONE_HELLFIRECITADEL = 3563;
    public const ZONE_THRALLMAR = 3536;
    public const ZONE_REUSE = 3537;
    public const ZONE_HONORHOLD = 3538;
    public const ZONE_THESTAIROFDESTINY = 3539;
    public const ZONE_TWISTINGNETHER = 3540;
    public const ZONE_FORGECAMPMAGEDDON = 3541;
    public const ZONE_THEPATHOFGLORY = 3542;
    public const ZONE_THEGREATFISSURE = 3543;
    public const ZONE_PLAINOFSHARDS = 3544;
    public const ZONE_EXPEDITIONARMORY = 3546;
    public const ZONE_THRONEOFKILJAEDEN = 3547;
    public const ZONE_FORGECAMPRAGE = 3548;
    public const ZONE_INVASIONPOINTANNIHILATOR = 3549;
    public const ZONE_BORUNERUINS = 3550;
    public const ZONE_RUINSOFSHANAAR = 3551;
    public const ZONE_TEMPLEOFTELHAMAT = 3552;
    public const ZONE_POOLSOFAGGONAR = 3553;
    public const ZONE_FALCONWATCH = 3554;
    public const ZONE_MAGHARPOST = 3555;
    public const ZONE_DENOFHAALESH = 3556;
    public const ZONE_THEEXODAR = 3557;
    public const ZONE_ELRENDARFALLS = 3558;
    public const ZONE_NESTLEWOODHILLS = 3559;
    public const ZONE_AMMENFIELDS = 3560;
    public const ZONE_THESACREDGROVE = 3561;
    public const ZONE_HELLFIRERAMPARTS = 3562;
    public const ZONE_EMBERGLADE = 3564;
    public const ZONE_CENARIONREFUGE = 3565;
    public const ZONE_MOONWINGDEN = 3566;
    public const ZONE_PODCLUSTER = 3567;
    public const ZONE_PODWRECKAGE = 3568;
    public const ZONE_TIDESHOLLOW = 3569;
    public const ZONE_WRATHSCALEPOINT = 3570;
    public const ZONE_BRISTLELIMBVILLAGE = 3571;
    public const ZONE_STILLPINEHOLD = 3572;
    public const ZONE_ODESYUSLANDING = 3573;
    public const ZONE_VALAARSBERTH = 3574;
    public const ZONE_SILTINGSHORE = 3575;
    public const ZONE_AZUREWATCH = 3576;
    public const ZONE_GEEZLESCAMP = 3577;
    public const ZONE_MENAGERIEWRECKAGE = 3578;
    public const ZONE_TRAITORSCOVE = 3579;
    public const ZONE_WILDWINDPEAK = 3580;
    public const ZONE_WILDWINDPATH = 3581;
    public const ZONE_ZETHGOR = 3582;
    public const ZONE_BERYLCOAST = 3583;
    public const ZONE_BLOODWATCH = 3584;
    public const ZONE_BLADEWOOD = 3585;
    public const ZONE_THEVECTORCOIL = 3586;
    public const ZONE_THEWARPPISTON = 3587;
    public const ZONE_THECRYOCORE = 3588;
    public const ZONE_THECRIMSONREACH = 3589;
    public const ZONE_WRATHSCALELAIR = 3590;
    public const ZONE_RUINSOFLORETHARAN = 3591;
    public const ZONE_NAZZIVIAN = 3592;
    public const ZONE_AXXARIEN = 3593;
    public const ZONE_BLACKSILTSHORE = 3594;
    public const ZONE_THEFOULPOOL = 3595;
    public const ZONE_THEHIDDENREEF = 3596;
    public const ZONE_AMBERWEBPASS = 3597;
    public const ZONE_WYRMSCARISLAND = 3598;
    public const ZONE_TALONSTAND = 3599;
    public const ZONE_BRISTLELIMBENCLAVE = 3600;
    public const ZONE_RAGEFEATHERRIDGE = 3601;
    public const ZONE_KESSELSCROSSING = 3602;
    public const ZONE_TELATHIONSCAMP = 3603;
    public const ZONE_THEBLOODCURSEDREEF = 3604;
    public const ZONE_HYJALPAST = 3605;
    public const ZONE_HYJALSUMMIT = 3606;
    public const ZONE_COILFANGRESERVOIR = 3905;
    public const ZONE_VINDICATORSREST = 3608;
    public const ZONE_BURNINGBLADERUINS = 3610;
    public const ZONE_CLANWATCH = 3611;
    public const ZONE_BLOODCURSEISLE = 3612;
    public const ZONE_GARADAR = 3613;
    public const ZONE_SKYSONGLAKE = 3614;
    public const ZONE_THRONEOFTHEELEMENTS = 3615;
    public const ZONE_LAUGHINGSKULLRUINS = 3616;
    public const ZONE_WARMAULHILL = 3617;
    public const ZONE_GRUULSLAIR = 3923;
    public const ZONE_AURENRIDGE = 3619;
    public const ZONE_AURENFALLS = 3620;
    public const ZONE_LAKESUNSPRING = 3621;
    public const ZONE_SUNSPRINGPOST = 3622;
    public const ZONE_AERISLANDING = 3623;
    public const ZONE_FORGECAMPFEAR = 3624;
    public const ZONE_FORGECAMPHATE = 3625;
    public const ZONE_TELAAR = 3626;
    public const ZONE_NORTHWINDCLEFT = 3627;
    public const ZONE_HALAA = 3628;
    public const ZONE_SOUTHWINDCLEFT = 3629;
    public const ZONE_OSHUGUN = 3630;
    public const ZONE_SPIRITFIELDS = 3631;
    public const ZONE_SHAMANAR = 3632;
    public const ZONE_ANCESTRALGROUNDS = 3633;
    public const ZONE_WINDYREEDVILLAGE = 3634;
    public const ZONE_ELEMENTALPLATEAU = 3636;
    public const ZONE_KILSORROWFORTRESS = 3637;
    public const ZONE_THERINGOFTRIALS = 3638;
    public const ZONE_SILVERMYSTISLE = 3639;
    public const ZONE_DAGGERFENVILLAGE = 3640;
    public const ZONE_UMBRAFENVILLAGE = 3641;
    public const ZONE_FERALFENVILLAGE = 3642;
    public const ZONE_BLOODSCALEENCLAVE = 3643;
    public const ZONE_TELREDOR = 3644;
    public const ZONE_ZABRAJIN = 3645;
    public const ZONE_QUAGGRIDGE = 3646;
    public const ZONE_THESPAWNINGGLEN = 3647;
    public const ZONE_THEDEADMIRE = 3648;
    public const ZONE_SPOREGGAR = 3649;
    public const ZONE_ANGOROSHGROUNDS = 3650;
    public const ZONE_ANGOROSHSTRONGHOLD = 3651;
    public const ZONE_FUNGGORCAVERN = 3652;
    public const ZONE_SERPENTLAKE = 3653;
    public const ZONE_THEDRAIN = 3654;
    public const ZONE_UMBRAFENLAKE = 3655;
    public const ZONE_MARSHLIGHTLAKE = 3656;
    public const ZONE_PORTALCLEARING = 3657;
    public const ZONE_SPOREWINDLAKE = 3658;
    public const ZONE_THELAGOON = 3659;
    public const ZONE_BLADESRUN = 3767;
    public const ZONE_BLADETOOTHCANYON = 3770;
    public const ZONE_COMMONSHALL = 3662;
    public const ZONE_DERELICTMANOR = 3663;
    public const ZONE_HUNTRESSOFTHESUN = 3664;
    public const ZONE_FALCONWINGSQUARE = 3665;
    public const ZONE_HALAANIBASIN = 3666;
    public const ZONE_HEWNBOG = 3667;
    public const ZONE_BOHAMURUINS = 3668;
    public const ZONE_THESTADIUM = 3669;
    public const ZONE_THEOVERLOOK = 3670;
    public const ZONE_BROKENHILL = 3671;
    public const ZONE_MAGHARIPROCESSION = 3672;
    public const ZONE_NESINGWARYSAFARI = 3673;
    public const ZONE_CENARIONTHICKET = 3674;
    public const ZONE_TUUREM = 3675;
    public const ZONE_VEILSHIENOR = 3676;
    public const ZONE_VEILSKITH = 3677;
    public const ZONE_VEILSHALAS = 3678;
    public const ZONE_SKETTIS = 3679;
    public const ZONE_BLACKWINDVALLEY = 3680;
    public const ZONE_FIREWINGPOINT = 3681;
    public const ZONE_GRANGOLVARVILLAGE = 3682;
    public const ZONE_STONEBREAKERHOLD = 3683;
    public const ZONE_ALLERIANSTRONGHOLD = 3684;
    public const ZONE_BONECHEWERRUINS = 3685;
    public const ZONE_VEILLITHIC = 3686;
    public const ZONE_OLEMBAS = 3687;
    public const ZONE_AUCHINDOUN = 3917;
    public const ZONE_VEILRESKK = 3689;
    public const ZONE_BLACKWINDLAKE = 3690;
    public const ZONE_LAKEERENORU = 3691;
    public const ZONE_LAKEJORUNE = 3692;
    public const ZONE_SKETHYLMOUNTAINS = 3693;
    public const ZONE_MISTYRIDGE = 3694;
    public const ZONE_THEBROKENHILLS = 3695;
    public const ZONE_THEBARRIERHILLS = 3760;
    public const ZONE_THEBONEWASTES = 3697;
    public const ZONE_NAGRANDARENA = 3698;
    public const ZONE_LAUGHINGSKULLCOURTYARD = 3699;
    public const ZONE_THERINGOFBLOOD = 3700;
    public const ZONE_ARENAFLOOR = 3701;
    public const ZONE_BLADESEDGEARENA = 3702;
    public const ZONE_SHATTRATHCITY = 3703;
    public const ZONE_THESHEPHERDSGATE = 3704;
    public const ZONE_TELAARIBASIN = 3705;
    public const ZONE_ALLIANCEBASE = 3707;
    public const ZONE_HORDEENCAMPMENT = 3708;
    public const ZONE_NIGHTELFVILLAGE = 3709;
    public const ZONE_NORDRASSIL = 3710;
    public const ZONE_BLACKTEMPLE = 3711;
    public const ZONE_AREA52 = 3712;
    public const ZONE_THEBLOODFURNACE = 3713;
    public const ZONE_THESHATTEREDHALLS = 3714;
    public const ZONE_THESTEAMVAULT = 3715;
    public const ZONE_THEUNDERBOG = 3716;
    public const ZONE_THESLAVEPENS = 3717;
    public const ZONE_SWAMPRATPOST = 3718;
    public const ZONE_BLEEDINGHOLLOWRUINS = 3719;
    public const ZONE_TWINSPIRERUINS = 3720;
    public const ZONE_THECRUMBLINGWASTE = 3721;
    public const ZONE_MANAFORGEARA = 3722;
    public const ZONE_ARKLONRUINS = 3723;
    public const ZONE_COSMOWRENCH = 3724;
    public const ZONE_RUINSOFENKAAT = 3725;
    public const ZONE_MANAFORGEBNAAR = 3726;
    public const ZONE_THESCRAPFIELD = 3727;
    public const ZONE_THEVORTEXFIELDS = 3728;
    public const ZONE_THEHEAP = 3729;
    public const ZONE_MANAFORGECORUU = 3730;
    public const ZONE_THETEMPESTRIFT = 3731;
    public const ZONE_KIRINVARVILLAGE = 3732;
    public const ZONE_THEVIOLETTOWER = 3733;
    public const ZONE_MANAFORGEDURO = 3734;
    public const ZONE_VOIDWINDPLATEAU = 3735;
    public const ZONE_MANAFORGEULTRIS = 3736;
    public const ZONE_CELESTIALRIDGE = 3737;
    public const ZONE_THESTORMSPIRE = 3738;
    public const ZONE_FORGEBASEOBLIVION = 3739;
    public const ZONE_FORGEBASEGEHENNA = 3740;
    public const ZONE_RUINSOFFARAHLON = 3741;
    public const ZONE_SOCRETHARSSEAT = 3742;
    public const ZONE_LEGIONHOLD = 3743;
    public const ZONE_SHADOWMOONVILLAGE = 3744;
    public const ZONE_WILDHAMMERSTRONGHOLD = 3745;
    public const ZONE_THEHANDOFGULDAN = 3746;
    public const ZONE_THEFELPITS = 3747;
    public const ZONE_THEDEATHFORGE = 3748;
    public const ZONE_COILSKARCISTERN = 3749;
    public const ZONE_COILSKARPOINT = 3750;
    public const ZONE_SUNFIREPOINT = 3751;
    public const ZONE_ILLIDARIPOINT = 3752;
    public const ZONE_RUINSOFBAARI = 3753;
    public const ZONE_ALTAROFSHATAR = 3754;
    public const ZONE_THESTAIROFDOOM = 3755;
    public const ZONE_RUINSOFKARABOR = 3756;
    public const ZONE_ATAMALTERRACE = 3757;
    public const ZONE_NETHERWINGFIELDS = 3758;
    public const ZONE_NETHERWINGLEDGE = 3759;
    public const ZONE_THEHIGHPATH = 3761;
    public const ZONE_WINDYREEDPASS = 3762;
    public const ZONE_ZANGARRIDGE = 3763;
    public const ZONE_THETWILIGHTRIDGE = 3764;
    public const ZONE_RAZORTHORNTRAIL = 3765;
    public const ZONE_OREBORHARBORAGE = 3766;
    public const ZONE_JAGGEDRIDGE = 3768;
    public const ZONE_THUNDERLORDSTRONGHOLD = 3769;
    public const ZONE_THELIVINGGROVE = 3771;
    public const ZONE_SYLVANAAR = 3772;
    public const ZONE_BLADESPIREHOLD = 3773;
    public const ZONE_CIRCLEOFBLOOD = 3775;
    public const ZONE_BLOODMAULOUTPOST = 3776;
    public const ZONE_BLOODMAULCAMP = 3777;
    public const ZONE_DRAENETHYSTMINE = 3778;
    public const ZONE_TROGMASCLAIM = 3779;
    public const ZONE_BLACKWINGCOVEN = 3780;
    public const ZONE_GRISHNATH = 3781;
    public const ZONE_VEILLASHH = 3782;
    public const ZONE_VEILVEKH = 3783;
    public const ZONE_FORGECAMPTERROR = 3784;
    public const ZONE_FORGECAMPWRATH = 3785;
    public const ZONE_FELSTORMPOINT = 3786;
    public const ZONE_FORGECAMPANGER = 3787;
    public const ZONE_THELOWPATH = 3788;
    public const ZONE_SHADOWLABYRINTH = 3789;
    public const ZONE_AUCHENAICRYPTS = 3790;
    public const ZONE_SETHEKKHALLS = 3791;
    public const ZONE_MANATOMBS = 3792;
    public const ZONE_FELSPARKRAVINE = 3793;
    public const ZONE_SHANAARIWASTES = 3795;
    public const ZONE_THEWARPFIELDS = 3796;
    public const ZONE_FALLENSKYRIDGE = 3797;
    public const ZONE_HAALESHIGORGE = 3798;
    public const ZONE_STONEWALLCANYON = 3799;
    public const ZONE_THORNFANGHILL = 3800;
    public const ZONE_MAGHARGROUNDS = 3801;
    public const ZONE_VOIDRIDGE = 3802;
    public const ZONE_THEABYSSALSHELF = 3803;
    public const ZONE_THELEGIONFRONT = 3804;
    public const ZONE_ZULAMAN = 3805;
    public const ZONE_SUPPLYCARAVAN = 3806;
    public const ZONE_REAVERSFALL = 3807;
    public const ZONE_CENARIONPOST = 3808;
    public const ZONE_SOUTHERNRAMPART = 3809;
    public const ZONE_NORTHERNRAMPART = 3810;
    public const ZONE_GORGAZOUTPOST = 3811;
    public const ZONE_SPINEBREAKERPOST = 3812;
    public const ZONE_THEPATHOFANGUISH = 3813;
    public const ZONE_EASTSUPPLYCARAVAN = 3814;
    public const ZONE_EXPEDITIONPOINT = 3815;
    public const ZONE_ZEPPELINCRASH = 3816;
    public const ZONE_TESTING = 3817;
    public const ZONE_BLOODSCALEGROUNDS = 3818;
    public const ZONE_DARKCRESTENCLAVE = 3819;
    public const ZONE_EYEOFTHESTORM = 3820;
    public const ZONE_WARDENSCAGE = 3821;
    public const ZONE_ECLIPSEPOINT = 3822;
    public const ZONE_ISLEOFTRIBULATIONS = 3823;
    public const ZONE_BLOODMAULRAVINE = 3824;
    public const ZONE_DRAGONSEND = 3825;
    public const ZONE_DAGGERMAWCANYON = 3826;
    public const ZONE_VEKHAARSTAND = 3827;
    public const ZONE_RUUANWEALD = 3828;
    public const ZONE_VEILRUUAN = 3829;
    public const ZONE_RAVENSWOOD = 3830;
    public const ZONE_DEATHSDOOR = 3831;
    public const ZONE_VORTEXPINNACLE = 3832;
    public const ZONE_RAZORRIDGE = 3833;
    public const ZONE_RIDGEOFMADNESS = 3834;
    public const ZONE_DUSTQUILLRAVINE = 3835;
    public const ZONE_MAGTHERIDONSLAIR = 3836;
    public const ZONE_SUNFURYHOLD = 3837;
    public const ZONE_SPINEBREAKERMOUNTAINS = 3838;
    public const ZONE_ABANDONEDARMORY = 3839;
    public const ZONE_THEBLACKTEMPLE = 3840;
    public const ZONE_DARKCRESTSHORE = 3841;
    public const ZONE_TEMPESTKEEP = 3845;
    public const ZONE_MOKNATHALVILLAGE = 3844;
    public const ZONE_THEARCATRAZ = 3848;
    public const ZONE_THEBOTANICA = 3847;
    public const ZONE_THEMECHANAR = 3849;
    public const ZONE_NETHERSTONE = 3850;
    public const ZONE_MIDREALMPOST = 3851;
    public const ZONE_TULUMANSLANDING = 3852;
    public const ZONE_PROTECTORATEWATCHPOST = 3854;
    public const ZONE_CIRCLEOFBLOODARENA = 3855;
    public const ZONE_ELRENDARCROSSING = 3856;
    public const ZONE_AMMENFORD = 3857;
    public const ZONE_RAZORTHORNSHELF = 3858;
    public const ZONE_SILMYRLAKE = 3859;
    public const ZONE_RAASTOKGLADE = 3860;
    public const ZONE_THALASSIANPASS = 3861;
    public const ZONE_CHURNINGGULCH = 3862;
    public const ZONE_BROKENWILDS = 3863;
    public const ZONE_BASHIRLANDING = 3864;
    public const ZONE_CRYSTALSPINE = 3865;
    public const ZONE_SKALD = 3866;
    public const ZONE_BLADEDGULCH = 3867;
    public const ZONE_GYROPLANKBRIDGE = 3868;
    public const ZONE_MAGETOWER = 3869;
    public const ZONE_BLOODELFTOWER = 3870;
    public const ZONE_DRAENEIRUINS = 3871;
    public const ZONE_FELREAVERRUINS = 3872;
    public const ZONE_THEPROVINGGROUNDS = 3873;
    public const ZONE_ECODOMEFARFIELD = 3874;
    public const ZONE_ECODOMESKYPERCH = 3875;
    public const ZONE_ECODOMESUTHERON = 3876;
    public const ZONE_ECODOMEMIDREALM = 3877;
    public const ZONE_ETHEREUMSTAGINGGROUNDS = 3878;
    public const ZONE_CHAPELYARD = 3879;
    public const ZONE_ACCESSSHAFTZEON = 3880;
    public const ZONE_TRELLEUMMINE = 3881;
    public const ZONE_INVASIONPOINTDESTROYER = 3882;
    public const ZONE_CAMPOFBOOM = 3883;
    public const ZONE_SPINEBREAKERPASS = 3884;
    public const ZONE_NETHERWEBRIDGE = 3885;
    public const ZONE_DERELICTCARAVAN = 3886;
    public const ZONE_REFUGEECARAVAN = 3887;
    public const ZONE_SHADOWTOMB = 3888;
    public const ZONE_VEILRHAZE = 3889;
    public const ZONE_TOMBOFLIGHTS = 3890;
    public const ZONE_CARRIONHILL = 3891;
    public const ZONE_WRITHINGMOUND = 3892;
    public const ZONE_RINGOFOBSERVANCE = 3893;
    public const ZONE_AUCHENAIGROUNDS = 3894;
    public const ZONE_CENARIONWATCHPOST = 3895;
    public const ZONE_ALDORRISE = 3896;
    public const ZONE_TERRACEOFLIGHT = 3897;
    public const ZONE_SCRYERSTIER = 3898;
    public const ZONE_LOWERCITY = 3899;
    public const ZONE_INVASIONPOINTOVERLORD = 3900;
    public const ZONE_ALLERIANPOST = 3901;
    public const ZONE_STONEBREAKERCAMP = 3902;
    public const ZONE_BOULDERMOK = 3903;
    public const ZONE_CURSEDHOLLOW = 3904;
    public const ZONE_THEBLOODWASH = 3906;
    public const ZONE_VERIDIANPOINT = 3907;
    public const ZONE_MIDDENVALE = 3908;
    public const ZONE_THELOSTFOLD = 3909;
    public const ZONE_MYSTWOOD = 3910;
    public const ZONE_TRANQUILSHORE = 3911;
    public const ZONE_GOLDENBOUGHPASS = 3912;
    public const ZONE_RUNESTONEFALITHAS = 3913;
    public const ZONE_RUNESTONESHANDOR = 3914;
    public const ZONE_FAIRBRIDGESTRAND = 3915;
    public const ZONE_MOONGRAZEWOODS = 3916;
    public const ZONE_TOSHLEYSSTATION = 3918;
    public const ZONE_SINGINGRIDGE = 3919;
    public const ZONE_SHATTERPOINT = 3920;
    public const ZONE_ARKLONISRIDGE = 3921;
    public const ZONE_BLADESPIREOUTPOST = 3922;
    public const ZONE_NORTHMAULTOWER = 3924;
    public const ZONE_SOUTHMAULTOWER = 3925;
    public const ZONE_SHATTEREDPLAINS = 3926;
    public const ZONE_ORONOKSFARM = 3927;
    public const ZONE_THEALTAROFDAMNATION = 3928;
    public const ZONE_THEPATHOFCONQUEST = 3929;
    public const ZONE_ECLIPSIONFIELDS = 3930;
    public const ZONE_BLADESPIREGROUNDS = 3931;
    public const ZONE_SKETHLONBASECAMP = 3932;
    public const ZONE_SKETHLONWRECKAGE = 3933;
    public const ZONE_TOWNSQUARE = 3934;
    public const ZONE_WIZARDROW = 3935;
    public const ZONE_DEATHFORGETOWER = 3936;
    public const ZONE_SLAGWATCH = 3937;
    public const ZONE_SANCTUMOFTHESTARS = 3938;
    public const ZONE_DRAGONMAWFORTRESS = 3939;
    public const ZONE_THEFETIDPOOL = 3940;
    public const ZONE_RAZAANSLANDING = 3942;
    public const ZONE_INVASIONPOINTCATACLYSM = 3943;
    public const ZONE_THEALTAROFSHADOWS = 3944;
    public const ZONE_NETHERWINGPASS = 3945;
    public const ZONE_WAYNESREFUGE = 3946;
    public const ZONE_THESCALDINGPOOLS = 3947;
    public const ZONE_BRIANANDPATTEST = 3948;
    public const ZONE_MAGMAFIELDS = 3949;
    public const ZONE_CRIMSONWATCH = 3950;
    public const ZONE_EVERGROVE = 3951;
    public const ZONE_WYRMSKULLBRIDGE = 3952;
    public const ZONE_SCALEWINGSHELF = 3953;
    public const ZONE_WYRMSKULLTUNNEL = 3954;
    public const ZONE_HELLFIREBASIN = 3955;
    public const ZONE_THESHADOWSTAIR = 3956;
    public const ZONE_SHATARIOUTPOST = 3957;

    public static function getZoneName($zoneId): string
    {
        switch ($zoneId) {
            case self::ZONE_DUNMOROGH:
                return 'Dun Morogh';
            case self::ZONE_LONGSHORE:
                return 'Longshore';
            case self::ZONE_BADLANDS:
                return 'Badlands';
            case self::ZONE_BLASTEDLANDS:
                return 'Blasted Lands';
            case self::ZONE_BLACKWATERCOVE:
                return 'Blackwater Cove';
            case self::ZONE_SWAMPOFSORROWS:
                return 'Swamp of Sorrows';
            case self::ZONE_NORTHSHIREVALLEY:
                return 'Northshire Valley';
            case self::ZONE_DUSKWOOD:
                return 'Duskwood';
            case self::ZONE_WETLANDS:
                return 'Wetlands';
            case self::ZONE_ELWYNNFOREST:
                return 'Elwynn Forest';
            case self::ZONE_THEWORLDTREE:
                return 'The World Tree';
            case self::ZONE_DUROTAR:
                return 'Durotar';
            case self::ZONE_DUSTWALLOWMARSH:
                return 'Dustwallow Marsh';
            case self::ZONE_AZSHARA:
                return 'Azshara';
            case self::ZONE_THEBARRENS:
                return 'The Barrens';
            case self::ZONE_CRYSTALLAKE:
                return 'Crystal Lake';
            case self::ZONE_ZULGURUB:
                return 'Zul\'Gurub';
            case self::ZONE_MOONBROOK:
                return 'Moonbrook';
            case self::ZONE_KULTIRAS:
                return 'Kul Tiras';
            case self::ZONE_PROGRAMMERISLE:
                return 'Programmer Isle';
            case self::ZONE_NORTHSHIRERIVER:
                return 'Northshire River';
            case self::ZONE_NORTHSHIREABBEY:
                return 'Northshire Abbey';
            case self::ZONE_BLACKROCKMOUNTAIN:
                return 'Blackrock Mountain';
            case self::ZONE_LIGHTHOUSE:
                return 'Lighthouse';
            case self::ZONE_WESTERNPLAGUELANDS:
                return 'Western Plaguelands';
            case self::ZONE_NINE:
                return 'Nine';
            case self::ZONE_THECEMETARY:
                return 'The Cemetary';
            case self::ZONE_STRANGLETHORNVALE:
                return 'Stranglethorn Vale';
            case self::ZONE_ECHORIDGEMINE:
                return 'Echo Ridge Mine';
            case self::ZONE_BOOTYBAY:
                return 'Booty Bay';
            case self::ZONE_ALTERACMOUNTAINS:
                return 'Alterac Mountains';
            case self::ZONE_LAKENAZFERITI:
                return 'Lake Nazferiti';
            case self::ZONE_LOCHMODAN:
                return 'Loch Modan';
            case self::ZONE_WESTFALL:
                return 'Westfall';
            case self::ZONE_DEADWINDPASS:
                return 'Deadwind Pass';
            case self::ZONE_DARKSHIRE:
                return 'Darkshire';
            case self::ZONE_WILDSHORE:
                return 'Wild Shore';
            case self::ZONE_REDRIDGEMOUNTAINS:
                return 'Redridge Mountains';
            case self::ZONE_ARATHIHIGHLANDS:
                return 'Arathi Highlands';
            case self::ZONE_BURNINGSTEPPES:
                return 'Burning Steppes';
            case self::ZONE_THEHINTERLANDS:
                return 'The Hinterlands';
            case self::ZONE_DEADMANSHOLE:
                return 'Dead Man\'s Hole';
            case self::ZONE_SEARINGGORGE:
                return 'Searing Gorge';
            case self::ZONE_THIEVESCAMP:
                return 'Thieves Camp';
            case self::ZONE_JASPERLODEMINE:
                return 'Jasperlode Mine';
            case self::ZONE_VALLEYOFHEROES:
                return 'Valley of Heroes';
            case self::ZONE_HEROESVIGIL:
                return 'Heroes\' Vigil';
            case self::ZONE_FARGODEEPMINE:
                return 'Fargodeep Mine';
            case self::ZONE_NORTHSHIREVINEYARDS:
                return 'Northshire Vineyards';
            case self::ZONE_FORESTSEDGE:
                return 'Forest\'s Edge';
            case self::ZONE_THUNDERFALLS:
                return 'Thunder Falls';
            case self::ZONE_BRACKWELLPUMPKINPATCH:
                return 'Brackwell Pumpkin Patch';
            case self::ZONE_THESTONEFIELDFARM:
                return 'The Stonefield Farm';
            case self::ZONE_THEMACLUREVINEYARDS:
                return 'The Maclure Vineyards';
            case self::ZONE_LAKEEVERSTILL:
                return 'Lake Everstill';
            case self::ZONE_LAKESHIRE:
                return 'Lakeshire';
            case self::ZONE_STONEWATCH:
                return 'Stonewatch';
            case self::ZONE_STONEWATCHFALLS:
                return 'Stonewatch Falls';
            case self::ZONE_THEDARKPORTAL:
                return 'The Dark Portal';
            case self::ZONE_THETAINTEDSCAR:
                return 'The Tainted Scar';
            case self::ZONE_POOLOFTEARS:
                return 'Pool of Tears';
            case self::ZONE_STONARD:
                return 'Stonard';
            case self::ZONE_FALLOWSANCTUARY:
                return 'Fallow Sanctuary';
            case self::ZONE_ANVILMAR:
                return 'Anvilmar';
            case self::ZONE_STORMWINDMOUNTAINS:
                return 'Stormwind Mountains';
            case self::ZONE_TIRISFALGLADES:
                return 'Tirisfal Glades';
            case self::ZONE_STONECAIRNLAKE:
                return 'Stone Cairn Lake';
            case self::ZONE_GOLDSHIRE:
                return 'Goldshire';
            case self::ZONE_EASTVALELOGGINGCAMP:
                return 'Eastvale Logging Camp';
            case self::ZONE_MIRRORLAKEORCHARD:
                return 'Mirror Lake Orchard';
            case self::ZONE_TOWEROFAZORA:
                return 'Tower of Azora';
            case self::ZONE_MIRRORLAKE:
                return 'Mirror Lake';
            case self::ZONE_VULGOLOGREMOUND:
                return 'Vul\'Gol Ogre Mound';
            case self::ZONE_RAVENHILL:
                return 'Raven Hill';
            case self::ZONE_REDRIDGECANYONS:
                return 'Redridge Canyons';
            case self::ZONE_TOWEROFILGALAR:
                return 'Tower of Ilgalar';
            case self::ZONE_ALTHERSMILL:
                return 'Alther\'s Mill';
            case self::ZONE_RETHBANCAVERNS:
                return 'Rethban Caverns';
            case self::ZONE_REBELCAMP:
                return 'Rebel Camp';
            case self::ZONE_NESINGWARYSEXPEDITION:
                return 'Nesingwary\'s Expedition';
            case self::ZONE_KURZENSCOMPOUND:
                return 'Kurzen\'s Compound';
            case self::ZONE_RUINSOFZULKUNDA:
                return 'Ruins of Zul\'Kunda';
            case self::ZONE_RUINSOFZULMAMWE:
                return 'Ruins of Zul\'Mamwe';
            case self::ZONE_THEVILEREEF:
                return 'The Vile Reef';
            case self::ZONE_MOSHOGGOGREMOUND:
                return 'Mosh\'Ogg Ogre Mound';
            case self::ZONE_THESTOCKPILE:
                return 'The Stockpile';
            case self::ZONE_SALDEANSFARM:
                return 'Saldean\'s Farm';
            case self::ZONE_SENTINELHILL:
                return 'Sentinel Hill';
            case self::ZONE_FURLBROWSPUMPKINFARM:
                return 'Furlbrow\'s Pumpkin Farm';
            case self::ZONE_JANGOLODEMINE:
                return 'Jangolode Mine';
            case self::ZONE_GOLDCOASTQUARRY:
                return 'Gold Coast Quarry';
            case self::ZONE_WESTFALLLIGHTHOUSE:
                return 'Westfall Lighthouse';
            case self::ZONE_MISTYVALLEY:
                return 'Misty Valley';
            case self::ZONE_GROMGOLBASECAMP:
                return 'Grom\'gol Base Camp';
            case self::ZONE_WHELGARSEXCAVATIONSITE:
                return 'Whelgar\'s Excavation Site';
            case self::ZONE_WESTBROOKGARRISON:
                return 'Westbrook Garrison';
            case self::ZONE_TRANQUILGARDENSCEMETERY:
                return 'Tranquil Gardens Cemetery';
            case self::ZONE_ZUULDAIARUINS:
                return 'Zuuldaia Ruins';
            case self::ZONE_BALLALRUINS:
                return 'Bal\'lal Ruins';
            case self::ZONE_KALAIRUINS:
                return 'Kal\'ai Ruins';
            case self::ZONE_TKASHIRUINS:
                return 'Tkashi Ruins';
            case self::ZONE_BALIAMAHRUINS:
                return 'Balia\'mah Ruins';
            case self::ZONE_ZIATAJAIRUINS:
                return 'Ziata\'jai Ruins';
            case self::ZONE_MIZJAHRUINS:
                return 'Mizjah Ruins';
            case self::ZONE_SILVERPINEFOREST:
                return 'Silverpine Forest';
            case self::ZONE_KHARANOS:
                return 'Kharanos';
            case self::ZONE_COLDRIDGEVALLEY:
                return 'Coldridge Valley';
            case self::ZONE_GNOMEREGAN:
                return 'Gnomeregan';
            case self::ZONE_GOLBOLARQUARRY:
                return 'Gol\'Bolar Quarry';
            case self::ZONE_FROSTMANEHOLD:
                return 'Frostmane Hold';
            case self::ZONE_THEGRIZZLEDDEN:
                return 'The Grizzled Den';
            case self::ZONE_BREWNALLVILLAGE:
                return 'Brewnall Village';
            case self::ZONE_MISTYPINEREFUGE:
                return 'Misty Pine Refuge';
            case self::ZONE_EASTERNPLAGUELANDS:
                return 'Eastern Plaguelands';
            case self::ZONE_TELDRASSIL:
                return 'Teldrassil';
            case self::ZONE_IRONBANDSEXCAVATIONSITE:
                return 'Ironband\'s Excavation Site';
            case self::ZONE_MOGROSHSTRONGHOLD:
                return 'Mo\'grosh Stronghold';
            case self::ZONE_THELSAMAR:
                return 'Thelsamar';
            case self::ZONE_ALGAZGATE:
                return 'Algaz Gate';
            case self::ZONE_STONEWROUGHTDAM:
                return 'Stonewrought Dam';
            case self::ZONE_THEFARSTRIDERLODGE:
                return 'The Farstrider Lodge';
            case self::ZONE_DARKSHORE:
                return 'Darkshore';
            case self::ZONE_SILVERSTREAMMINE:
                return 'Silver Stream Mine';
            case self::ZONE_MENETHILHARBOR:
                return 'Menethil Harbor';
            case self::ZONE_DESIGNERISLAND:
                return 'Designer Island';
            case self::ZONE_THEBULWARK:
                return 'The Bulwark';
            case self::ZONE_RUINSOFLORDAERON:
                return 'Ruins of Lordaeron';
            case self::ZONE_DEATHKNELL:
                return 'Deathknell';
            case self::ZONE_NIGHTWEBSHOLLOW:
                return 'Night Web\'s Hollow';
            case self::ZONE_SOLLIDENFARMSTEAD:
                return 'Solliden Farmstead';
            case self::ZONE_AGAMANDMILLS:
                return 'Agamand Mills';
            case self::ZONE_AGAMANDFAMILYCRYPT:
                return 'Agamand Family Crypt';
            case self::ZONE_BRILL:
                return 'Brill';
            case self::ZONE_WHISPERINGGARDENS:
                return 'Whispering Gardens';
            case self::ZONE_TERRACEOFREPOSE:
                return 'Terrace of Repose';
            case self::ZONE_BRIGHTWATERLAKE:
                return 'Brightwater Lake';
            case self::ZONE_GUNTHERSRETREAT:
                return 'Gunther\'s Retreat';
            case self::ZONE_GARRENSHAUNT:
                return 'Garren\'s Haunt';
            case self::ZONE_BALNIRFARMSTEAD:
                return 'Balnir Farmstead';
            case self::ZONE_COLDHEARTHMANOR:
                return 'Cold Hearth Manor';
            case self::ZONE_CRUSADEROUTPOST:
                return 'Crusader Outpost';
            case self::ZONE_THENORTHCOAST:
                return 'The North Coast';
            case self::ZONE_WHISPERINGSHORE:
                return 'Whispering Shore';
            case self::ZONE_LORDAMERELAKE:
                return 'Lordamere Lake';
            case self::ZONE_FENRISISLE:
                return 'Fenris Isle';
            case self::ZONE_FAOLSREST:
                return 'Faol\'s Rest';
            case self::ZONE_DOLANAAR:
                return 'Dolanaar';
            case self::ZONE_SHADOWGLEN:
                return 'Shadowglen';
            case self::ZONE_STEELGRILLSDEPOT:
                return 'Steelgrill\'s Depot';
            case self::ZONE_HEARTHGLEN:
                return 'Hearthglen';
            case self::ZONE_NORTHRIDGELUMBERCAMP:
                return 'Northridge Lumber Camp';
            case self::ZONE_RUINSOFANDORHAL:
                return 'Ruins of Andorhal';
            case self::ZONE_SCHOOLOFNECROMANCY:
                return 'School of Necromancy';
            case self::ZONE_UTHERSTOMB:
                return 'Uther\'s Tomb';
            case self::ZONE_SORROWHILL:
                return 'Sorrow Hill';
            case self::ZONE_THEWEEPINGCAVE:
                return 'The Weeping Cave';
            case self::ZONE_FELSTONEFIELD:
                return 'Felstone Field';
            case self::ZONE_DALSONSTEARS:
                return 'Dalson\'s Tears';
            case self::ZONE_GAHRRONSWITHERING:
                return 'Gahrron\'s Withering';
            case self::ZONE_THEWRITHINGHAUNT:
                return 'The Writhing Haunt';
            case self::ZONE_MARDENHOLDEKEEP:
                return 'Mardenholde Keep';
            case self::ZONE_PYREWOODVILLAGE:
                return 'Pyrewood Village';
            case self::ZONE_DUNMODR:
                return 'Dun Modr';
            case self::ZONE_THEGREATSEA:
                return 'The Great Sea';
            case self::ZONE_UNUSEDIRONCLADCOVE:
                return 'Unused Ironcladcove';
            case self::ZONE_SHADOWFANGKEEP:
                return 'Shadowfang Keep';
            case self::ZONE_ICEFLOWLAKE:
                return 'Iceflow Lake';
            case self::ZONE_HELMSBEDLAKE:
                return 'Helm\'s Bed Lake';
            case self::ZONE_DEEPELEMMINE:
                return 'Deep Elem Mine';
            case self::ZONE_MULGORE:
                return 'Mulgore';
            case self::ZONE_ALEXSTONFARMSTEAD:
                return 'Alexston Farmstead';
            case self::ZONE_REDCLOUDMESA:
                return 'Red Cloud Mesa';
            case self::ZONE_CAMPNARACHE:
                return 'Camp Narache';
            case self::ZONE_BLOODHOOFVILLAGE:
                return 'Bloodhoof Village';
            case self::ZONE_STONEBULLLAKE:
                return 'Stonebull Lake';
            case self::ZONE_RAVAGEDCARAVAN:
                return 'Ravaged Caravan';
            case self::ZONE_REDROCKS:
                return 'Red Rocks';
            case self::ZONE_THESKITTERINGDARK:
                return 'The Skittering Dark';
            case self::ZONE_VALGANSFIELD:
                return 'Valgan\'s Field';
            case self::ZONE_THESEPULCHER:
                return 'The Sepulcher';
            case self::ZONE_OLSENSFARTHING:
                return 'Olsen\'s Farthing';
            case self::ZONE_THEGREYMANEWALL:
                return 'The Greymane Wall';
            case self::ZONE_BERENSPERIL:
                return 'Beren\'s Peril';
            case self::ZONE_THEDAWNINGISLES:
                return 'The Dawning Isles';
            case self::ZONE_AMBERMILL:
                return 'Ambermill';
            case self::ZONE_FENRISKEEP:
                return 'Fenris Keep';
            case self::ZONE_THEDECREPITFERRY:
                return 'The Decrepit Ferry';
            case self::ZONE_MALDENSORCHARD:
                return 'Malden\'s Orchard';
            case self::ZONE_THEIVARPATCH:
                return 'The Ivar Patch';
            case self::ZONE_THEDEADFIELD:
                return 'The Dead Field';
            case self::ZONE_THEROTTINGORCHARD:
                return 'The Rotting Orchard';
            case self::ZONE_BRIGHTWOODGROVE:
                return 'Brightwood Grove';
            case self::ZONE_FORLORNROWE:
                return 'Forlorn Rowe';
            case self::ZONE_THEWHIPPLEESTATE:
                return 'The Whipple Estate';
            case self::ZONE_THEYORGENFARMSTEAD:
                return 'The Yorgen Farmstead';
            case self::ZONE_THECAULDRON:
                return 'The Cauldron';
            case self::ZONE_GRIMESILTDIGSITE:
                return 'Grimesilt Dig Site';
            case self::ZONE_DREADMAULROCK:
                return 'Dreadmaul Rock';
            case self::ZONE_RUINSOFTHAURISSAN:
                return 'Ruins of Thaurissan';
            case self::ZONE_FLAMECREST:
                return 'Flame Crest';
            case self::ZONE_BLACKROCKSTRONGHOLD:
                return 'Blackrock Stronghold';
            case self::ZONE_THEPILLAROFASH:
                return 'The Pillar of Ash';
            case self::ZONE_ALTAROFSTORMS:
                return 'Altar of Storms';
            case self::ZONE_ALDRASSIL:
                return 'Aldrassil';
            case self::ZONE_SHADOWTHREADCAVE:
                return 'Shadowthread Cave';
            case self::ZONE_FELROCK:
                return 'Fel Rock';
            case self::ZONE_LAKEALAMETH:
                return 'Lake Al\'Ameth';
            case self::ZONE_STARBREEZEVILLAGE:
                return 'Starbreeze Village';
            case self::ZONE_GNARLPINEHOLD:
                return 'Gnarlpine Hold';
            case self::ZONE_BANETHILBARROWDEN:
                return 'Ban\'ethil Barrow Den';
            case self::ZONE_THECLEFT:
                return 'The Cleft';
            case self::ZONE_THEORACLEGLADE:
                return 'The Oracle Glade';
            case self::ZONE_WELLSPRINGRIVER:
                return 'Wellspring River';
            case self::ZONE_WELLSPRINGLAKE:
                return 'Wellspring Lake';
            case self::ZONE_HILLSBRADFOOTHILLS:
                return 'Hillsbrad Foothills';
            case self::ZONE_AZSHARACRATER:
                return 'Azshara Crater';
            case self::ZONE_DUNALGAZ:
                return 'Dun Algaz';
            case self::ZONE_SOUTHSHORE:
                return 'Southshore';
            case self::ZONE_TARRENMILL:
                return 'Tarren Mill';
            case self::ZONE_DURNHOLDEKEEP:
                return 'Durnholde Keep';
            case self::ZONE_STONEWROUGHTPASS:
                return 'Stonewrought Pass';
            case self::ZONE_THEFOOTHILLCAVERNS:
                return 'The Foothill Caverns';
            case self::ZONE_LORDAMEREINTERNMENTCAMP:
                return 'Lordamere Internment Camp';
            case self::ZONE_DALARAN:
                return 'Dalaran';
            case self::ZONE_STRAHNBRAD:
                return 'Strahnbrad';
            case self::ZONE_RUINSOFALTERAC:
                return 'Ruins of Alterac';
            case self::ZONE_CRUSHRIDGEHOLD:
                return 'Crushridge Hold';
            case self::ZONE_SLAUGHTERHOLLOW:
                return 'Slaughter Hollow';
            case self::ZONE_THEUPLANDS:
                return 'The Uplands';
            case self::ZONE_SOUTHPOINTTOWER:
                return 'Southpoint Tower';
            case self::ZONE_HILLSBRADFIELDS:
                return 'Hillsbrad Fields';
            case self::ZONE_HILLSBRAD:
                return 'Hillsbrad';
            case self::ZONE_AZURELODEMINE:
                return 'Azurelode Mine';
            case self::ZONE_NETHANDERSTEAD:
                return 'Nethander Stead';
            case self::ZONE_DUNGAROK:
                return 'Dun Garok';
            case self::ZONE_THORADINSWALL:
                return 'Thoradin\'s Wall';
            case self::ZONE_EASTERNSTRAND:
                return 'Eastern Strand';
            case self::ZONE_WESTERNSTRAND:
                return 'Western Strand';
            case self::ZONE_JAGUEROISLE:
                return 'Jaguero Isle';
            case self::ZONE_BARADINBAY:
                return 'Baradin Bay';
            case self::ZONE_MENETHILBAY:
                return 'Menethil Bay';
            case self::ZONE_MISTYREEDSTRAND:
                return 'Misty Reed Strand';
            case self::ZONE_THESAVAGECOAST:
                return 'The Savage Coast';
            case self::ZONE_THECRYSTALSHORE:
                return 'The Crystal Shore';
            case self::ZONE_SHELLBEACH:
                return 'Shell Beach';
            case self::ZONE_NORTHTIDESRUN:
                return 'North Tide\'s Run';
            case self::ZONE_SOUTHTIDESRUN:
                return 'South Tide\'s Run';
            case self::ZONE_THEOVERLOOKCLIFFS:
                return 'The Overlook Cliffs';
            case self::ZONE_THEFORBIDDINGSEA:
                return 'The Forbidding Sea';
            case self::ZONE_IRONBEARDSTOMB:
                return 'Ironbeard\'s Tomb';
            case self::ZONE_CRYSTALVEINMINE:
                return 'Crystalvein Mine';
            case self::ZONE_RUINSOFABORAZ:
                return 'Ruins of Aboraz';
            case self::ZONE_JANEIROSPOINT:
                return 'Janeiro\'s Point';
            case self::ZONE_NORTHFOLDMANOR:
                return 'Northfold Manor';
            case self::ZONE_GOSHEKFARM:
                return 'Go\'Shek Farm';
            case self::ZONE_DABYRIESFARMSTEAD:
                return 'Dabyrie\'s Farmstead';
            case self::ZONE_BOULDERFISTHALL:
                return 'Boulderfist Hall';
            case self::ZONE_WITHERBARKVILLAGE:
                return 'Witherbark Village';
            case self::ZONE_DRYWHISKERGORGE:
                return 'Drywhisker Gorge';
            case self::ZONE_REFUGEPOINTE:
                return 'Refuge Pointe';
            case self::ZONE_HAMMERFALL:
                return 'Hammerfall';
            case self::ZONE_BLACKWATERSHIPWRECKS:
                return 'Blackwater Shipwrecks';
            case self::ZONE_OBREENSCAMP:
                return 'O\'Breen\'s Camp';
            case self::ZONE_STROMGARDEKEEP:
                return 'Stromgarde Keep';
            case self::ZONE_THETOWEROFARATHOR:
                return 'The Tower of Arathor';
            case self::ZONE_THESANCTUM:
                return 'The Sanctum';
            case self::ZONE_FALDIRSCOVE:
                return 'Faldir\'s Cove';
            case self::ZONE_THEDROWNEDREEF:
                return 'The Drowned Reef';
            case self::ZONE_THANDOLSPAN:
                return 'Thandol Span';
            case self::ZONE_ASHENVALE:
                return 'Ashenvale';
            case self::ZONE_CIRCLEOFEASTBINDING:
                return 'Circle of East Binding';
            case self::ZONE_CIRCLEOFWESTBINDING:
                return 'Circle of West Binding';
            case self::ZONE_CIRCLEOFINNERBINDING:
                return 'Circle of Inner Binding';
            case self::ZONE_CIRCLEOFOUTERBINDING:
                return 'Circle of Outer Binding';
            case self::ZONE_APOCRYPHANSREST:
                return 'Apocryphan\'s Rest';
            case self::ZONE_ANGORFORTRESS:
                return 'Angor Fortress';
            case self::ZONE_LETHLORRAVINE:
                return 'Lethlor Ravine';
            case self::ZONE_KARGATH:
                return 'Kargath';
            case self::ZONE_CAMPKOSH:
                return 'Camp Kosh';
            case self::ZONE_CAMPBOFF:
                return 'Camp Boff';
            case self::ZONE_CAMPWURG:
                return 'Camp Wurg';
            case self::ZONE_CAMPCAGG:
                return 'Camp Cagg';
            case self::ZONE_AGMONDSEND:
                return 'Agmond\'s End';
            case self::ZONE_HAMMERTOESDIGSITE:
                return 'Hammertoe\'s Digsite';
            case self::ZONE_DUSTBELCHGROTTO:
                return 'Dustbelch Grotto';
            case self::ZONE_AERIEPEAK:
                return 'Aerie Peak';
            case self::ZONE_WILDHAMMERKEEP:
                return 'Wildhammer Keep';
            case self::ZONE_QUELDANILLODGE:
                return 'Quel\'Danil Lodge';
            case self::ZONE_SKULKROCK:
                return 'Skulk Rock';
            case self::ZONE_ZUNWATHA:
                return 'Zun\'watha';
            case self::ZONE_SHADRAALOR:
                return 'Shadra\'Alor';
            case self::ZONE_JINTHAALOR:
                return 'Jintha\'Alor';
            case self::ZONE_THEALTAROFZUL:
                return 'The Altar of Zul';
            case self::ZONE_SERADANE:
                return 'Seradane';
            case self::ZONE_FERALAS:
                return 'Feralas';
            case self::ZONE_BRAMBLEBLADERAVINE:
                return 'Brambleblade Ravine';
            case self::ZONE_BAELMODAN:
                return 'Bael Modan';
            case self::ZONE_THEVENTURECOMINE:
                return 'The Venture Co. Mine';
            case self::ZONE_FELWOOD:
                return 'Felwood';
            case self::ZONE_RAZORHILL:
                return 'Razor Hill';
            case self::ZONE_VALLEYOFTRIALS:
                return 'Valley of Trials';
            case self::ZONE_THEDEN:
                return 'The Den';
            case self::ZONE_BURNINGBLADECOVEN:
                return 'Burning Blade Coven';
            case self::ZONE_KOLKARCRAG:
                return 'Kolkar Crag';
            case self::ZONE_SENJINVILLAGE:
                return 'Sen\'jin Village';
            case self::ZONE_ECHOISLES:
                return 'Echo Isles';
            case self::ZONE_THUNDERRIDGE:
                return 'Thunder Ridge';
            case self::ZONE_DRYGULCHRAVINE:
                return 'Drygulch Ravine';
            case self::ZONE_DUSTWINDCAVE:
                return 'Dustwind Cave';
            case self::ZONE_TIRAGARDEKEEP:
                return 'Tiragarde Keep';
            case self::ZONE_SCUTTLECOAST:
                return 'Scuttle Coast';
            case self::ZONE_BLADEFISTBAY:
                return 'Bladefist Bay';
            case self::ZONE_DEADEYESHORE:
                return 'Deadeye Shore';
            case self::ZONE_SOUTHFURYRIVER:
                return 'Southfury River';
            case self::ZONE_CAMPTAURAJO:
                return 'Camp Taurajo';
            case self::ZONE_FARWATCHPOST:
                return 'Far Watch Post';
            case self::ZONE_THECROSSROADS:
                return 'The Crossroads';
            case self::ZONE_BOULDERLODEMINE:
                return 'Boulder Lode Mine';
            case self::ZONE_THESLUDGEFEN:
                return 'The Sludge Fen';
            case self::ZONE_THEDRYHILLS:
                return 'The Dry Hills';
            case self::ZONE_DREADMISTPEAK:
                return 'Dreadmist Peak';
            case self::ZONE_NORTHWATCHHOLD:
                return 'Northwatch Hold';
            case self::ZONE_THEFORGOTTENPOOLS:
                return 'The Forgotten Pools';
            case self::ZONE_LUSHWATEROASIS:
                return 'Lushwater Oasis';
            case self::ZONE_THESTAGNANTOASIS:
                return 'The Stagnant Oasis';
            case self::ZONE_FIELDOFGIANTS:
                return 'Field of Giants';
            case self::ZONE_THEMERCHANTCOAST:
                return 'The Merchant Coast';
            case self::ZONE_RATCHET:
                return 'Ratchet';
            case self::ZONE_DARKSPEARSTRAND:
                return 'Darkspear Strand';
            case self::ZONE_WINTERHOOFWATERWELL:
                return 'Winterhoof Water Well';
            case self::ZONE_THUNDERHORNWATERWELL:
                return 'Thunderhorn Water Well';
            case self::ZONE_WILDMANEWATERWELL:
                return 'Wildmane Water Well';
            case self::ZONE_SKYLINERIDGE:
                return 'Skyline Ridge';
            case self::ZONE_THOUSANDNEEDLES:
                return 'Thousand Needles';
            case self::ZONE_THETIDUSSTAIR:
                return 'The Tidus Stair';
            case self::ZONE_SHADYRESTINN:
                return 'Shady Rest Inn';
            case self::ZONE_BAELDUNDIGSITE:
                return 'Bael\'dun Digsite';
            case self::ZONE_DESOLACE:
                return 'Desolace';
            case self::ZONE_STONETALONMOUNTAINS:
                return 'Stonetalon Mountains';
            case self::ZONE_GILLIJIMSISLE:
                return 'Gillijim\'s Isle';
            case self::ZONE_ISLANDOFDOCTORLAPIDIS:
                return 'Island of Doctor Lapidis';
            case self::ZONE_RAZORWINDCANYON:
                return 'Razorwind Canyon';
            case self::ZONE_BATHRANSHAUNT:
                return 'Bathran\'s Haunt';
            case self::ZONE_THERUINSOFORDILARAN:
                return 'The Ruins of Ordil\'Aran';
            case self::ZONE_MAESTRASPOST:
                return 'Maestra\'s Post';
            case self::ZONE_THEZORAMSTRAND:
                return 'The Zoram Strand';
            case self::ZONE_ASTRANAAR:
                return 'Astranaar';
            case self::ZONE_THESHRINEOFAESSINA:
                return 'The Shrine of Aessina';
            case self::ZONE_FIRESCARSHRINE:
                return 'Fire Scar Shrine';
            case self::ZONE_THERUINSOFSTARDUST:
                return 'The Ruins of Stardust';
            case self::ZONE_THEHOWLINGVALE:
                return 'The Howling Vale';
            case self::ZONE_SILVERWINDREFUGE:
                return 'Silverwind Refuge';
            case self::ZONE_MYSTRALLAKE:
                return 'Mystral Lake';
            case self::ZONE_FALLENSKYLAKE:
                return 'Fallen Sky Lake';
            case self::ZONE_IRISLAKE:
                return 'Iris Lake';
            case self::ZONE_MOONWELL:
                return 'Moonwell';
            case self::ZONE_RAYNEWOODRETREAT:
                return 'Raynewood Retreat';
            case self::ZONE_THESHADYNOOK:
                return 'The Shady Nook';
            case self::ZONE_NIGHTRUN:
                return 'Night Run';
            case self::ZONE_XAVIAN:
                return 'Xavian';
            case self::ZONE_SATYRNAAR:
                return 'Satyrnaar';
            case self::ZONE_SPLINTERTREEPOST:
                return 'Splintertree Post';
            case self::ZONE_THEDORDANILBARROWDEN:
                return 'The Dor\'Danil Barrow Den';
            case self::ZONE_FALFARRENRIVER:
                return 'Falfarren River';
            case self::ZONE_FELFIREHILL:
                return 'Felfire Hill';
            case self::ZONE_DEMONFALLCANYON:
                return 'Demon Fall Canyon';
            case self::ZONE_DEMONFALLRIDGE:
                return 'Demon Fall Ridge';
            case self::ZONE_WARSONGLUMBERCAMP:
                return 'Warsong Lumber Camp';
            case self::ZONE_BOUGHSHADOW:
                return 'Bough Shadow';
            case self::ZONE_THESHIMMERINGFLATS:
                return 'The Shimmering Flats';
            case self::ZONE_TANARIS:
                return 'Tanaris';
            case self::ZONE_LAKEFALATHIM:
                return 'Lake Falathim';
            case self::ZONE_AUBERDINE:
                return 'Auberdine';
            case self::ZONE_RUINSOFMATHYSTRA:
                return 'Ruins of Mathystra';
            case self::ZONE_TOWEROFALTHALAXX:
                return 'Tower of Althalaxx';
            case self::ZONE_CLIFFSPRINGFALLS:
                return 'Cliffspring Falls';
            case self::ZONE_BASHALARAN:
                return 'Bashal\'Aran';
            case self::ZONE_AMETHARAN:
                return 'Ameth\'Aran';
            case self::ZONE_GROVEOFTHEANCIENTS:
                return 'Grove of the Ancients';
            case self::ZONE_THEMASTERSGLAIVE:
                return 'The Master\'s Glaive';
            case self::ZONE_REMTRAVELSEXCAVATION:
                return 'Remtravel\'s Excavation';
            case self::ZONE_MISTSEDGE:
                return 'Mist\'s Edge';
            case self::ZONE_THELONGWASH:
                return 'The Long Wash';
            case self::ZONE_WILDBENDRIVER:
                return 'Wildbend River';
            case self::ZONE_BLACKWOODDEN:
                return 'Blackwood Den';
            case self::ZONE_CLIFFSPRINGRIVER:
                return 'Cliffspring River';
            case self::ZONE_THEVEILEDSEA:
                return 'The Veiled Sea';
            case self::ZONE_GOLDROAD:
                return 'Gold Road';
            case self::ZONE_SCARLETWATCHPOST:
                return 'Scarlet Watch Post';
            case self::ZONE_SUNROCKRETREAT:
                return 'Sun Rock Retreat';
            case self::ZONE_WINDSHEARCRAG:
                return 'Windshear Crag';
            case self::ZONE_CRAGPOOLLAKE:
                return 'Cragpool Lake';
            case self::ZONE_MIRKFALLONLAKE:
                return 'Mirkfallon Lake';
            case self::ZONE_THECHARREDVALE:
                return 'The Charred Vale';
            case self::ZONE_VALLEYOFTHEBLOODFURIES:
                return 'Valley of the Bloodfuries';
            case self::ZONE_STONETALONPEAK:
                return 'Stonetalon Peak';
            case self::ZONE_THETALONDEN:
                return 'The Talon Den';
            case self::ZONE_GREATWOODVALE:
                return 'Greatwood Vale';
            case self::ZONE_BRAVEWINDMESA:
                return 'Brave Wind Mesa';
            case self::ZONE_FIRESTONEMESA:
                return 'Fire Stone Mesa';
            case self::ZONE_MANTLEROCK:
                return 'Mantle Rock';
            case self::ZONE_RUINSOFJUBUWAL:
                return 'Ruins of Jubuwal';
            case self::ZONE_POOLSOFARLITHRIEN:
                return 'Pools of Arlithrien';
            case self::ZONE_THERUSTMAULDIGSITE:
                return 'The Rustmaul Dig Site';
            case self::ZONE_CAMPETHOK:
                return 'Camp E\'thok';
            case self::ZONE_SPLITHOOFCRAG:
                return 'Splithoof Crag';
            case self::ZONE_HIGHPERCH:
                return 'Highperch';
            case self::ZONE_THESCREECHINGCANYON:
                return 'The Screeching Canyon';
            case self::ZONE_FREEWINDPOST:
                return 'Freewind Post';
            case self::ZONE_THEGREATLIFT:
                return 'The Great Lift';
            case self::ZONE_GALAKHOLD:
                return 'Galak Hold';
            case self::ZONE_ROGUEFEATHERDEN:
                return 'Roguefeather Den';
            case self::ZONE_THEWEATHEREDNOOK:
                return 'The Weathered Nook';
            case self::ZONE_THALANAAR:
                return 'Thalanaar';
            case self::ZONE_UNGOROCRATER:
                return 'Un\'Goro Crater';
            case self::ZONE_RAZORFENKRAUL:
                return 'Razorfen Kraul';
            case self::ZONE_RAVENHILLCEMETERY:
                return 'Raven Hill Cemetery';
            case self::ZONE_MOONGLADE:
                return 'Moonglade';
            case self::ZONE_BRACKENWALLVILLAGE:
                return 'Brackenwall Village';
            case self::ZONE_SWAMPLIGHTMANOR:
                return 'Swamplight Manor';
            case self::ZONE_BLOODFENBURROW:
                return 'Bloodfen Burrow';
            case self::ZONE_DARKMISTCAVERN:
                return 'Darkmist Cavern';
            case self::ZONE_MOGGLEPOINT:
                return 'Moggle Point';
            case self::ZONE_BEEZILSWRECK:
                return 'Beezil\'s Wreck';
            case self::ZONE_WITCHHILL:
                return 'Witch Hill';
            case self::ZONE_SENTRYPOINT:
                return 'Sentry Point';
            case self::ZONE_NORTHPOINTTOWER:
                return 'North Point Tower';
            case self::ZONE_WESTPOINTTOWER:
                return 'West Point Tower';
            case self::ZONE_LOSTPOINT:
                return 'Lost Point';
            case self::ZONE_BLUEFEN:
                return 'Bluefen';
            case self::ZONE_STONEMAULRUINS:
                return 'Stonemaul Ruins';
            case self::ZONE_THEDENOFFLAME:
                return 'The Den of Flame';
            case self::ZONE_THEDRAGONMURK:
                return 'The Dragonmurk';
            case self::ZONE_WYRMBOG:
                return 'Wyrmbog';
            case self::ZONE_ONYXIASLAIR:
                return 'Onyxia\'s Lair';
            case self::ZONE_THERAMOREISLE:
                return 'Theramore Isle';
            case self::ZONE_FOOTHOLDCITADEL:
                return 'Foothold Citadel';
            case self::ZONE_IRONCLADPRISON:
                return 'Ironclad Prison';
            case self::ZONE_DUSTWALLOWBAY:
                return 'Dustwallow Bay';
            case self::ZONE_TIDEFURYCOVE:
                return 'Tidefury Cove';
            case self::ZONE_DREADMURKSHORE:
                return 'Dreadmurk Shore';
            case self::ZONE_ADDLESSTEAD:
                return 'Addle\'s Stead';
            case self::ZONE_FIREPLUMERIDGE:
                return 'Fire Plume Ridge';
            case self::ZONE_LAKKARITARPITS:
                return 'Lakkari Tar Pits';
            case self::ZONE_TERRORRUN:
                return 'Terror Run';
            case self::ZONE_THESLITHERINGSCAR:
                return 'The Slithering Scar';
            case self::ZONE_MARSHALSREFUGE:
                return 'Marshal\'s Refuge';
            case self::ZONE_FUNGALROCK:
                return 'Fungal Rock';
            case self::ZONE_GOLAKKAHOTSPRINGS:
                return 'Golakka Hot Springs';
            case self::ZONE_THELOCH:
                return 'The Loch';
            case self::ZONE_BEGGARSHAUNT:
                return 'Beggar\'s Haunt';
            case self::ZONE_KODOGRAVEYARD:
                return 'Kodo Graveyard';
            case self::ZONE_GHOSTWALKERPOST:
                return 'Ghost Walker Post';
            case self::ZONE_SARTHERISSTRAND:
                return 'Sar\'theris Strand';
            case self::ZONE_THUNDERAXEFORTRESS:
                return 'Thunder Axe Fortress';
            case self::ZONE_BOLGANSHOLE:
                return 'Bolgan\'s Hole';
            case self::ZONE_MANNOROCCOVEN:
                return 'Mannoroc Coven';
            case self::ZONE_SARGERON:
                return 'Sargeron';
            case self::ZONE_MAGRAMVILLAGE:
                return 'Magram Village';
            case self::ZONE_GELKISVILLAGE:
                return 'Gelkis Village';
            case self::ZONE_VALLEYOFSPEARS:
                return 'Valley of Spears';
            case self::ZONE_NIJELSPOINT:
                return 'Nijel\'s Point';
            case self::ZONE_KOLKARVILLAGE:
                return 'Kolkar Village';
            case self::ZONE_HYJAL:
                return 'Hyjal';
            case self::ZONE_WINTERSPRING:
                return 'Winterspring';
            case self::ZONE_BLACKWOLFRIVER:
                return 'Blackwolf River';
            case self::ZONE_KODOROCK:
                return 'Kodo Rock';
            case self::ZONE_HIDDENPATH:
                return 'Hidden Path';
            case self::ZONE_SPIRITROCK:
                return 'Spirit Rock';
            case self::ZONE_SHRINEOFTHEDORMANTFLAME:
                return 'Shrine of the Dormant Flame';
            case self::ZONE_LAKEELUNEARA:
                return 'Lake Elune\'ara';
            case self::ZONE_THEHARBORAGE:
                return 'The Harborage';
            case self::ZONE_OUTLAND:
                return 'Outland';
            case self::ZONE_CRAFTSMENSTERRACE:
                return 'Craftsmen\'s Terrace';
            case self::ZONE_TRADESMENSTERRACE:
                return 'Tradesmen\'s Terrace';
            case self::ZONE_THETEMPLEGARDENS:
                return 'The Temple Gardens';
            case self::ZONE_TEMPLEOFELUNE:
                return 'Temple of Elune';
            case self::ZONE_CENARIONENCLAVE:
                return 'Cenarion Enclave';
            case self::ZONE_WARRIORSTERRACE:
                return 'Warrior\'s Terrace';
            case self::ZONE_RUTTHERANVILLAGE:
                return 'Rut\'theran Village';
            case self::ZONE_IRONBANDSCOMPOUND:
                return 'Ironband\'s Compound';
            case self::ZONE_THESTOCKADE:
                return 'The Stockade';
            case self::ZONE_WAILINGCAVERNS:
                return 'Wailing Caverns';
            case self::ZONE_BLACKFATHOMDEEPS:
                return 'Blackfathom Deeps';
            case self::ZONE_FRAYISLAND:
                return 'Fray Island';
            case self::ZONE_RAZORFENDOWNS:
                return 'Razorfen Downs';
            case self::ZONE_BANETHILHOLLOW:
                return 'Ban\'ethil Hollow';
            case self::ZONE_SCARLETMONASTERY:
                return 'Scarlet Monastery';
            case self::ZONE_JERODSLANDING:
                return 'Jerod\'s Landing';
            case self::ZONE_RIDGEPOINTTOWER:
                return 'Ridgepoint Tower';
            case self::ZONE_THEDARKENEDBANK:
                return 'The Darkened Bank';
            case self::ZONE_COLDRIDGEPASS:
                return 'Coldridge Pass';
            case self::ZONE_CHILLBREEZEVALLEY:
                return 'Chill Breeze Valley';
            case self::ZONE_SHIMMERRIDGE:
                return 'Shimmer Ridge';
            case self::ZONE_AMBERSTILLRANCH:
                return 'Amberstill Ranch';
            case self::ZONE_THETUNDRIDHILLS:
                return 'The Tundrid Hills';
            case self::ZONE_SOUTHGATEPASS:
                return 'South Gate Pass';
            case self::ZONE_SOUTHGATEOUTPOST:
                return 'South Gate Outpost';
            case self::ZONE_NORTHGATEPASS:
                return 'North Gate Pass';
            case self::ZONE_NORTHGATEOUTPOST:
                return 'North Gate Outpost';
            case self::ZONE_GATESOFIRONFORGE:
                return 'Gates of Ironforge';
            case self::ZONE_STILLWATERPOND:
                return 'Stillwater Pond';
            case self::ZONE_NIGHTMAREVALE:
                return 'Nightmare Vale';
            case self::ZONE_VENOMWEBVALE:
                return 'Venomweb Vale';
            case self::ZONE_RAZORMANEGROUNDS:
                return 'Razormane Grounds';
            case self::ZONE_SKULLROCK:
                return 'Skull Rock';
            case self::ZONE_PALEMANEROCK:
                return 'Palemane Rock';
            case self::ZONE_WINDFURYRIDGE:
                return 'Windfury Ridge';
            case self::ZONE_THEGOLDENPLAINS:
                return 'The Golden Plains';
            case self::ZONE_THEROLLINGPLAINS:
                return 'The Rolling Plains';
            case self::ZONE_TWILIGHTGROVE:
                return 'Twilight Grove';
            case self::ZONE_GMISLAND:
                return 'GM Island';
            case self::ZONE_PURGATIONISLE:
                return 'Purgation Isle';
            case self::ZONE_THEJANSENSTEAD:
                return 'The Jansen Stead';
            case self::ZONE_THEDEADACRE:
                return 'The Dead Acre';
            case self::ZONE_THEMOLSENFARM:
                return 'The Molsen Farm';
            case self::ZONE_STENDELSPOND:
                return 'Stendel\'s Pond';
            case self::ZONE_THEDAGGERHILLS:
                return 'The Dagger Hills';
            case self::ZONE_DEMONTSPLACE:
                return 'Demont\'s Place';
            case self::ZONE_THEDUSTPLAINS:
                return 'The Dust Plains';
            case self::ZONE_STONESPLINTERVALLEY:
                return 'Stonesplinter Valley';
            case self::ZONE_VALLEYOFKINGS:
                return 'Valley of Kings';
            case self::ZONE_ALGAZSTATION:
                return 'Algaz Station';
            case self::ZONE_BUCKLEBREEFARM:
                return 'Bucklebree Farm';
            case self::ZONE_THESHININGSTRAND:
                return 'The Shining Strand';
            case self::ZONE_NORTHTIDESHOLLOW:
                return 'North Tide\'s Hollow';
            case self::ZONE_GRIZZLEPAWRIDGE:
                return 'Grizzlepaw Ridge';
            case self::ZONE_THEVERDANTFIELDS:
                return 'The Verdant Fields';
            case self::ZONE_GADGETZAN:
                return 'Gadgetzan';
            case self::ZONE_STEAMWHEEDLEPORT:
                return 'Steamwheedle Port';
            case self::ZONE_ZULFARRAK:
                return 'Zul\'Farrak';
            case self::ZONE_SANDSORROWWATCH:
                return 'Sandsorrow Watch';
            case self::ZONE_THISTLESHRUBVALLEY:
                return 'Thistleshrub Valley';
            case self::ZONE_THEGAPINGCHASM:
                return 'The Gaping Chasm';
            case self::ZONE_THENOXIOUSLAIR:
                return 'The Noxious Lair';
            case self::ZONE_DUNEMAULCOMPOUND:
                return 'Dunemaul Compound';
            case self::ZONE_EASTMOONRUINS:
                return 'Eastmoon Ruins';
            case self::ZONE_WATERSPRINGFIELD:
                return 'Waterspring Field';
            case self::ZONE_ZALASHJISDEN:
                return 'Zalashji\'s Den';
            case self::ZONE_LANDSENDBEACH:
                return 'Land\'s End Beach';
            case self::ZONE_WAVESTRIDERBEACH:
                return 'Wavestrider Beach';
            case self::ZONE_ULDUM:
                return 'Uldum';
            case self::ZONE_VALLEYOFTHEWATCHERS:
                return 'Valley of the Watchers';
            case self::ZONE_GUNSTANSPOST:
                return 'Gunstan\'s Post';
            case self::ZONE_SOUTHMOONRUINS:
                return 'Southmoon Ruins';
            case self::ZONE_RENDERSCAMP:
                return 'Render\'s Camp';
            case self::ZONE_RENDERSVALLEY:
                return 'Render\'s Valley';
            case self::ZONE_RENDERSROCK:
                return 'Render\'s Rock';
            case self::ZONE_STONEWATCHTOWER:
                return 'Stonewatch Tower';
            case self::ZONE_GALARDELLVALLEY:
                return 'Galardell Valley';
            case self::ZONE_LAKERIDGEHIGHWAY:
                return 'Lakeridge Highway';
            case self::ZONE_THREECORNERS:
                return 'Three Corners';
            case self::ZONE_DIREFORGEHILL:
                return 'Direforge Hill';
            case self::ZONE_RAPTORRIDGE:
                return 'Raptor Ridge';
            case self::ZONE_BLACKCHANNELMARSH:
                return 'Black Channel Marsh';
            case self::ZONE_THEGREENBELT:
                return 'The Green Belt';
            case self::ZONE_MOSSHIDEFEN:
                return 'Mosshide Fen';
            case self::ZONE_THELGENROCK:
                return 'Thelgen Rock';
            case self::ZONE_BLUEGILLMARSH:
                return 'Bluegill Marsh';
            case self::ZONE_SALTSPRAYGLEN:
                return 'Saltspray Glen';
            case self::ZONE_SUNDOWNMARSH:
                return 'Sundown Marsh';
            case self::ZONE_ANGERFANGENCAMPMENT:
                return 'Angerfang Encampment';
            case self::ZONE_GRIMBATOL:
                return 'Grim Batol';
            case self::ZONE_DRAGONMAWGATES:
                return 'Dragonmaw Gates';
            case self::ZONE_THELOSTFLEET:
                return 'The Lost Fleet';
            case self::ZONE_DARROWHILL:
                return 'Darrow Hill';
            case self::ZONE_WEBWINDERPATH:
                return 'Webwinder Path';
            case self::ZONE_THEHUSHEDBANK:
                return 'The Hushed Bank';
            case self::ZONE_MANORMISTMANTLE:
                return 'Manor Mistmantle';
            case self::ZONE_CAMPMOJACHE:
                return 'Camp Mojache';
            case self::ZONE_GRIMTOTEMCOMPOUND:
                return 'Grimtotem Compound';
            case self::ZONE_THEWRITHINGDEEP:
                return 'The Writhing Deep';
            case self::ZONE_WILDWINDLAKE:
                return 'Wildwind Lake';
            case self::ZONE_GORDUNNIOUTPOST:
                return 'Gordunni Outpost';
            case self::ZONE_MOKGORDUN:
                return 'Mok\'Gordun';
            case self::ZONE_FERALSCARVALE:
                return 'Feral Scar Vale';
            case self::ZONE_FRAYFEATHERHIGHLANDS:
                return 'Frayfeather Highlands';
            case self::ZONE_IDLEWINDLAKE:
                return 'Idlewind Lake';
            case self::ZONE_THEFORGOTTENCOAST:
                return 'The Forgotten Coast';
            case self::ZONE_EASTPILLAR:
                return 'East Pillar';
            case self::ZONE_WESTPILLAR:
                return 'West Pillar';
            case self::ZONE_DREAMBOUGH:
                return 'Dream Bough';
            case self::ZONE_JADEMIRLAKE:
                return 'Jademir Lake';
            case self::ZONE_ONEIROS:
                return 'Oneiros';
            case self::ZONE_RUINSOFRAVENWIND:
                return 'Ruins of Ravenwind';
            case self::ZONE_RAGESCARHOLD:
                return 'Rage Scar Hold';
            case self::ZONE_FEATHERMOONSTRONGHOLD:
                return 'Feathermoon Stronghold';
            case self::ZONE_RUINSOFSOLARSAL:
                return 'Ruins of Solarsal';
            case self::ZONE_THETWINCOLOSSALS:
                return 'The Twin Colossals';
            case self::ZONE_SARDORISLE:
                return 'Sardor Isle';
            case self::ZONE_ISLEOFDREAD:
                return 'Isle of Dread';
            case self::ZONE_HIGHWILDERNESS:
                return 'High Wilderness';
            case self::ZONE_LOWERWILDS:
                return 'Lower Wilds';
            case self::ZONE_SOUTHERNBARRENS:
                return 'Southern Barrens';
            case self::ZONE_SOUTHERNGOLDROAD:
                return 'Southern Gold Road';
            case self::ZONE_TIMBERMAWHOLD:
                return 'Timbermaw Hold';
            case self::ZONE_VANNDIRENCAMPMENT:
                return 'Vanndir Encampment';
            case self::ZONE_LEGASHENCAMPMENT:
                return 'Legash Encampment';
            case self::ZONE_THALASSIANBASECAMP:
                return 'Thalassian Base Camp';
            case self::ZONE_RUINSOFELDARATH:
                return 'Ruins of Eldarath';
            case self::ZONE_HETAERASCLUTCH:
                return 'Hetaera\'s Clutch';
            case self::ZONE_TEMPLEOFZINMALOR:
                return 'Temple of Zin-Malor';
            case self::ZONE_BEARSHEAD:
                return 'Bear\'s Head';
            case self::ZONE_URSOLAN:
                return 'Ursolan';
            case self::ZONE_TEMPLEOFARKKORAN:
                return 'Temple of Arkkoran';
            case self::ZONE_BAYOFSTORMS:
                return 'Bay of Storms';
            case self::ZONE_THESHATTEREDSTRAND:
                return 'The Shattered Strand';
            case self::ZONE_TOWEROFELDARA:
                return 'Tower of Eldara';
            case self::ZONE_JAGGEDREEF:
                return 'Jagged Reef';
            case self::ZONE_SOUTHRIDGEBEACH:
                return 'Southridge Beach';
            case self::ZONE_RAVENCRESTMONUMENT:
                return 'Ravencrest Monument';
            case self::ZONE_FORLORNRIDGE:
                return 'Forlorn Ridge';
            case self::ZONE_LAKEMENNAR:
                return 'Lake Mennar';
            case self::ZONE_SHADOWSONGSHRINE:
                return 'Shadowsong Shrine';
            case self::ZONE_HALDARRENCAMPMENT:
                return 'Haldarr Encampment';
            case self::ZONE_VALORMOK:
                return 'Valormok';
            case self::ZONE_THERUINEDREACHES:
                return 'The Ruined Reaches';
            case self::ZONE_THETALONDEEPPATH:
                return 'The Talondeep Path';
            case self::ZONE_ROCKTUSKFARM:
                return 'Rocktusk Farm';
            case self::ZONE_JAGGEDSWINEFARM:
                return 'Jaggedswine Farm';
            case self::ZONE_LOSTRIGGERCOVE:
                return 'Lost Rigger Cove';
            case self::ZONE_ULDAMAN:
                return 'Uldaman';
            case self::ZONE_GALLOWSCORNER:
                return 'Gallows\' Corner';
            case self::ZONE_SILITHUS:
                return 'Silithus';
            case self::ZONE_EMERALDFOREST:
                return 'Emerald Forest';
            case self::ZONE_SUNKENTEMPLE:
                return 'Sunken Temple';
            case self::ZONE_DREADMAULHOLD:
                return 'Dreadmaul Hold';
            case self::ZONE_NETHERGARDEKEEP:
                return 'Nethergarde Keep';
            case self::ZONE_DREADMAULPOST:
                return 'Dreadmaul Post';
            case self::ZONE_SERPENTSCOIL:
                return 'Serpent\'s Coil';
            case self::ZONE_FIREWATCHRIDGE:
                return 'Firewatch Ridge';
            case self::ZONE_THESLAGPIT:
                return 'The Slag Pit';
            case self::ZONE_THESEAOFCINDERS:
                return 'The Sea of Cinders';
            case self::ZONE_THORIUMPOINT:
                return 'Thorium Point';
            case self::ZONE_GARRISONARMORY:
                return 'Garrison Armory';
            case self::ZONE_THETEMPLEOFATALHAKKAR:
                return 'The Temple of Atal\'Hakkar';
            case self::ZONE_UNDERCITY:
                return 'Undercity';
            case self::ZONE_NOTUSEDDEADMINES:
                return 'Not Used Deadmines';
            case self::ZONE_STORMWINDCITY:
                return 'Stormwind City';
            case self::ZONE_IRONFORGE:
                return 'Ironforge';
            case self::ZONE_SPLITHOOFHOLD:
                return 'Splithoof Hold';
            case self::ZONE_THECAPEOFSTRANGLETHORN:
                return 'The Cape of Stranglethorn';
            case self::ZONE_SOUTHERNSAVAGECOAST:
                return 'Southern Savage Coast';
            case self::ZONE_UNUSEDTHEDEADMINES002:
                return 'Unused The Deadmines 002';
            case self::ZONE_UNUSEDIRONCLADCOVE003:
                return 'Unused Ironclad Cove 003';
            case self::ZONE_THEDEADMINES:
                return 'The Deadmines';
            case self::ZONE_IRONCLADCOVE:
                return 'Ironclad Cove';
            case self::ZONE_BLACKROCKSPIRE:
                return 'Blackrock Spire';
            case self::ZONE_BLACKROCKDEPTHS:
                return 'Blackrock Depths';
            case self::ZONE_RAPTORGROUNDSUNUSED:
                return 'Raptor Grounds UNUSED';
            case self::ZONE_GROLDOMFARMUNUSED:
                return 'Grol\'dom Farm UNUSED';
            case self::ZONE_MORSHANBASECAMP:
                return 'Mor\'shan Base Camp';
            case self::ZONE_HONORSSTANDUNUSED:
                return 'Honor\'s Stand UNUSED';
            case self::ZONE_BLACKTHORNRIDGEUNUSED:
                return 'Blackthorn Ridge UNUSED';
            case self::ZONE_BRAMBLESCARUNUSED:
                return 'Bramblescar UNUSED';
            case self::ZONE_AGAMAGORUNUSED:
                return 'Agama\'gor UNUSED';
            case self::ZONE_ORGRIMMAR:
                return 'Orgrimmar';
            case self::ZONE_THUNDERBLUFF:
                return 'Thunder Bluff';
            case self::ZONE_ELDERRISE:
                return 'Elder Rise';
            case self::ZONE_SPIRITRISE:
                return 'Spirit Rise';
            case self::ZONE_HUNTERRISE:
                return 'Hunter Rise';
            case self::ZONE_DARNASSUS:
                return 'Darnassus';
            case self::ZONE_GAVINSNAZE:
                return 'Gavin\'s Naze';
            case self::ZONE_SOFERASNAZE:
                return 'Sofera\'s Naze';
            case self::ZONE_CORRAHNSDAGGER:
                return 'Corrahn\'s Dagger';
            case self::ZONE_THEHEADLAND:
                return 'The Headland';
            case self::ZONE_MISTYSHORE:
                return 'Misty Shore';
            case self::ZONE_DANDREDSFOLD:
                return 'Dandred\'s Fold';
            case self::ZONE_GROWLESSCAVE:
                return 'Growless Cave';
            case self::ZONE_CHILLWINDPOINT:
                return 'Chillwind Point';
            case self::ZONE_RAPTORGROUNDS:
                return 'Raptor Grounds';
            case self::ZONE_BRAMBLESCAR:
                return 'Bramblescar';
            case self::ZONE_THORNHILL:
                return 'Thorn Hill';
            case self::ZONE_AGAMAGOR:
                return 'Agama\'gor';
            case self::ZONE_BLACKTHORNRIDGE:
                return 'Blackthorn Ridge';
            case self::ZONE_HONORSSTAND:
                return 'Honor\'s Stand';
            case self::ZONE_THEMORSHANRAMPART:
                return 'The Mor\'shan Rampart';
            case self::ZONE_GROLDOMFARM:
                return 'Grol\'dom Farm';
            case self::ZONE_MISTVALEVALLEY:
                return 'Mistvale Valley';
            case self::ZONE_NEKMANIWELLSPRING:
                return 'Nek\'mani Wellspring';
            case self::ZONE_BLOODSAILCOMPOUND:
                return 'Bloodsail Compound';
            case self::ZONE_VENTURECOBASECAMP:
                return 'Venture Co. Base Camp';
            case self::ZONE_GURUBASHIARENA:
                return 'Gurubashi Arena';
            case self::ZONE_SPIRITDEN:
                return 'Spirit Den';
            case self::ZONE_THECRIMSONVEIL:
                return 'The Crimson Veil';
            case self::ZONE_THERIPTIDE:
                return 'The Riptide';
            case self::ZONE_THEDAMSELSLUCK:
                return 'The Damsel\'s Luck';
            case self::ZONE_VENTURECOOPERATIONSCENTER:
                return 'Venture Co. Operations Center';
            case self::ZONE_DEADWOODVILLAGE:
                return 'Deadwood Village';
            case self::ZONE_FELPAWVILLAGE:
                return 'Felpaw Village';
            case self::ZONE_JAEDENAR:
                return 'Jaedenar';
            case self::ZONE_BLOODVENOMRIVER:
                return 'Bloodvenom River';
            case self::ZONE_BLOODVENOMFALLS:
                return 'Bloodvenom Falls';
            case self::ZONE_SHATTERSCARVALE:
                return 'Shatter Scar Vale';
            case self::ZONE_IRONTREEWOODS:
                return 'Irontree Woods';
            case self::ZONE_IRONTREECAVERN:
                return 'Irontree Cavern';
            case self::ZONE_SHADOWHOLD:
                return 'Shadow Hold';
            case self::ZONE_SHRINEOFTHEDECEIVER:
                return 'Shrine of the Deceiver';
            case self::ZONE_ITHARIUSSCAVE:
                return 'Itharius\'s Cave';
            case self::ZONE_SORROWMURK:
                return 'Sorrowmurk';
            case self::ZONE_DRAENILDURVILLAGE:
                return 'Draenil\'dur Village';
            case self::ZONE_SPLINTERSPEARJUNCTION:
                return 'Splinterspear Junction';
            case self::ZONE_STAGALBOG:
                return 'Stagalbog';
            case self::ZONE_THESHIFTINGMIRE:
                return 'The Shifting Mire';
            case self::ZONE_STAGALBOGCAVE:
                return 'Stagalbog Cave';
            case self::ZONE_WITHERBARKCAVERNS:
                return 'Witherbark Caverns';
            case self::ZONE_BOULDERGOR:
                return 'Boulder\'gor';
            case self::ZONE_VALLEYOFFANGS:
                return 'Valley of Fangs';
            case self::ZONE_THEDUSTBOWL:
                return 'The Dustbowl';
            case self::ZONE_MIRAGEFLATS:
                return 'Mirage Flats';
            case self::ZONE_FEATHERBEARDSHOVEL:
                return 'Featherbeard\'s Hovel';
            case self::ZONE_SHINDIGGERSCAMP:
                return 'Shindigger\'s Camp';
            case self::ZONE_PLAGUEMISTRAVINE:
                return 'Plaguemist Ravine';
            case self::ZONE_VALORWINDLAKE:
                return 'Valorwind Lake';
            case self::ZONE_AGOLWATHA:
                return 'Agol\'watha';
            case self::ZONE_HIRIWATHA:
                return 'Hiri\'watha';
            case self::ZONE_THECREEPINGRUIN:
                return 'The Creeping Ruin';
            case self::ZONE_BOGENSLEDGE:
                return 'Bogen\'s Ledge';
            case self::ZONE_THEMAKERSTERRACE:
                return 'The Maker\'s Terrace';
            case self::ZONE_DUSTWINDGULCH:
                return 'Dustwind Gulch';
            case self::ZONE_SHAOLWATHA:
                return 'Shaol\'watha';
            case self::ZONE_NOONSHADERUINS:
                return 'Noonshade Ruins';
            case self::ZONE_BROKENPILLAR:
                return 'Broken Pillar';
            case self::ZONE_ABYSSALSANDS:
                return 'Abyssal Sands';
            case self::ZONE_SOUTHBREAKSHORE:
                return 'Southbreak Shore';
            case self::ZONE_CAVERNSOFTIME:
                return 'Caverns of Time';
            case self::ZONE_THEMARSHLANDS:
                return 'The Marshlands';
            case self::ZONE_IRONSTONEPLATEAU:
                return 'Ironstone Plateau';
            case self::ZONE_BLACKCHARCAVE:
                return 'Blackchar Cave';
            case self::ZONE_TANNERCAMP:
                return 'Tanner Camp';
            case self::ZONE_DUSTFIREVALLEY:
                return 'Dustfire Valley';
            case self::ZONE_MISTYREEDPOST:
                return 'Misty Reed Post';
            case self::ZONE_BLOODVENOMPOST:
                return 'Bloodvenom Post';
            case self::ZONE_TALONBRANCHGLADE:
                return 'Talonbranch Glade';
            case self::ZONE_STRATHOLME:
                return 'Stratholme';
            case self::ZONE_QUELTHALAS:
                return 'Quel\'thalas';
            case self::ZONE_SCHOLOMANCE:
                return 'Scholomance';
            case self::ZONE_TWILIGHTVALE:
                return 'Twilight Vale';
            case self::ZONE_TWILIGHTSHORE:
                return 'Twilight Shore';
            case self::ZONE_ALCAZISLAND:
                return 'Alcaz Island';
            case self::ZONE_DARKCLOUDPINNACLE:
                return 'Darkcloud Pinnacle';
            case self::ZONE_DAWNINGWOODCATACOMBS:
                return 'Dawning Wood Catacombs';
            case self::ZONE_STONEWATCHKEEP:
                return 'Stonewatch Keep';
            case self::ZONE_MARAUDON:
                return 'Maraudon';
            case self::ZONE_STOUTLAGERINN:
                return 'Stoutlager Inn';
            case self::ZONE_THUNDERBREWDISTILLERY:
                return 'Thunderbrew Distillery';
            case self::ZONE_MENETHILKEEP:
                return 'Menethil Keep';
            case self::ZONE_DEEPWATERTAVERN:
                return 'Deepwater Tavern';
            case self::ZONE_SHADOWGRAVE:
                return 'Shadow Grave';
            case self::ZONE_BRILLTOWNHALL:
                return 'Brill Town Hall';
            case self::ZONE_GALLOWSENDTAVERN:
                return 'Gallows\' End Tavern';
            case self::ZONE_THEPOOLSOFVISION:
                return 'The Pools of Vision';
            case self::ZONE_DREADMISTDEN:
                return 'Dreadmist Den';
            case self::ZONE_BAELDUNKEEP:
                return 'Bael\'dun Keep';
            case self::ZONE_EMBERSTRIFESDEN:
                return 'Emberstrife\'s Den';
            case self::ZONE_WINDSHEARMINE:
                return 'Windshear Mine';
            case self::ZONE_ROLANDSDOOM:
                return 'Roland\'s Doom';
            case self::ZONE_BATTLERING:
                return 'Battle Ring';
            case self::ZONE_SHADOWBREAKRAVINE:
                return 'Shadowbreak Ravine';
            case self::ZONE_BROKENSPEARVILLAGE:
                return 'Broken Spear Village';
            case self::ZONE_WHITEREACHPOST:
                return 'Whitereach Post';
            case self::ZONE_GORNIA:
                return 'Gornia';
            case self::ZONE_ZANESEYECRATER:
                return 'Zane\'s Eye Crater';
            case self::ZONE_MIRAGERACEWAY:
                return 'Mirage Raceway';
            case self::ZONE_FROSTSABERROCK:
                return 'Frostsaber Rock';
            case self::ZONE_THEHIDDENGROVE:
                return 'The Hidden Grove';
            case self::ZONE_TIMBERMAWPOST:
                return 'Timbermaw Post';
            case self::ZONE_WINTERFALLVILLAGE:
                return 'Winterfall Village';
            case self::ZONE_MAZTHORIL:
                return 'Mazthoril';
            case self::ZONE_FROSTFIREHOTSPRINGS:
                return 'Frostfire Hot Springs';
            case self::ZONE_ICETHISTLEHILLS:
                return 'Ice Thistle Hills';
            case self::ZONE_DUNMANDARR:
                return 'Dun Mandarr';
            case self::ZONE_FROSTWHISPERGORGE:
                return 'Frostwhisper Gorge';
            case self::ZONE_OWLWINGTHICKET:
                return 'Owl Wing Thicket';
            case self::ZONE_LAKEKELTHERIL:
                return 'Lake Kel\'Theril';
            case self::ZONE_THERUINSOFKELTHERIL:
                return 'The Ruins of Kel\'Theril';
            case self::ZONE_STARFALLVILLAGE:
                return 'Starfall Village';
            case self::ZONE_BANTHALLOWBARROWDEN:
                return 'Ban\'Thallow Barrow Den';
            case self::ZONE_EVERLOOK:
                return 'Everlook';
            case self::ZONE_DARKWHISPERGORGE:
                return 'Darkwhisper Gorge';
            case self::ZONE_DEEPRUNTRAM:
                return 'Deeprun Tram';
            case self::ZONE_THEFUNGALVALE:
                return 'The Fungal Vale';
            case self::ZONE_THEMARRISSTEAD:
                return 'The Marris Stead';
            case self::ZONE_THEUNDERCROFT:
                return 'The Undercroft';
            case self::ZONE_DARROWSHIRE:
                return 'Darrowshire';
            case self::ZONE_CROWNGUARDTOWER:
                return 'Crown Guard Tower';
            case self::ZONE_CORINSCROSSING:
                return 'Corin\'s Crossing';
            case self::ZONE_SCARLETBASECAMP:
                return 'Scarlet Base Camp';
            case self::ZONE_TYRSHAND:
                return 'Tyr\'s Hand';
            case self::ZONE_THESCARLETBASILICA:
                return 'The Scarlet Basilica';
            case self::ZONE_LIGHTSHOPECHAPEL:
                return 'Light\'s Hope Chapel';
            case self::ZONE_BROWMANMILL:
                return 'Browman Mill';
            case self::ZONE_THENOXIOUSGLADE:
                return 'The Noxious Glade';
            case self::ZONE_EASTWALLTOWER:
                return 'Eastwall Tower';
            case self::ZONE_NORTHDALE:
                return 'Northdale';
            case self::ZONE_ZULMASHAR:
                return 'Zul\'Mashar';
            case self::ZONE_MAZRAALOR:
                return 'Mazra\'Alor';
            case self::ZONE_NORTHPASSTOWER:
                return 'Northpass Tower';
            case self::ZONE_QUELLITHIENLODGE:
                return 'Quel\'Lithien Lodge';
            case self::ZONE_PLAGUEWOOD:
                return 'Plaguewood';
            case self::ZONE_SCOURGEHOLD:
                return 'Scourgehold';
            case self::ZONE_DARROWMERELAKE:
                return 'Darrowmere Lake';
            case self::ZONE_CAERDARROW:
                return 'Caer Darrow';
            case self::ZONE_THISTLEFURVILLAGE:
                return 'Thistlefur Village';
            case self::ZONE_THEQUAGMIRE:
                return 'The Quagmire';
            case self::ZONE_WINDBREAKCANYON:
                return 'Windbreak Canyon';
            case self::ZONE_SOUTHSEAS:
                return 'South Seas';
            case self::ZONE_RAZORHILLBARRACKS:
                return 'Razor Hill Barracks';
            case self::ZONE_BLOODTOOTHCAMP:
                return 'Bloodtooth Camp';
            case self::ZONE_FORESTSONG:
                return 'Forest Song';
            case self::ZONE_GREENPAWVILLAGE:
                return 'Greenpaw Village';
            case self::ZONE_SILVERWINGOUTPOST:
                return 'Silverwing Outpost';
            case self::ZONE_NIGHTHAVEN:
                return 'Nighthaven';
            case self::ZONE_SHRINEOFREMULOS:
                return 'Shrine of Remulos';
            case self::ZONE_STORMRAGEBARROWDENS:
                return 'Stormrage Barrow Dens';
            case self::ZONE_THEBLACKMORASS:
                return 'The Black Morass';
            case self::ZONE_OLDHILLSBRADFOOTHILLS:
                return 'Old Hillsbrad Foothills';
            case self::ZONE_TETHRISARAN:
                return 'Tethris Aran';
            case self::ZONE_ETHELRETHOR:
                return 'Ethel Rethor';
            case self::ZONE_RANAZJARISLE:
                return 'Ranazjar Isle';
            case self::ZONE_KORMEKSHUT:
                return 'Kormek\'s Hut';
            case self::ZONE_SHADOWPREYVILLAGE:
                return 'Shadowprey Village';
            case self::ZONE_BLACKROCKPASS:
                return 'Blackrock Pass';
            case self::ZONE_MORGANSVIGIL:
                return 'Morgan\'s Vigil';
            case self::ZONE_SLITHERROCK:
                return 'Slither Rock';
            case self::ZONE_TERRORWINGPATH:
                return 'Terror Wing Path';
            case self::ZONE_DRACODAR:
                return 'Draco\'dar';
            case self::ZONE_RAGEFIRECHASM:
                return 'Ragefire Chasm';
            case self::ZONE_NIGHTSONGWOODS:
                return 'Nightsong Woods';
            case self::ZONE_MORLOSARAN:
                return 'Morlos\'Aran';
            case self::ZONE_EMERALDSANCTUARY:
                return 'Emerald Sanctuary';
            case self::ZONE_JADEFIREGLEN:
                return 'Jadefire Glen';
            case self::ZONE_RUINSOFCONSTELLAS:
                return 'Ruins of Constellas';
            case self::ZONE_BITTERREACHES:
                return 'Bitter Reaches';
            case self::ZONE_RISEOFTHEDEFILER:
                return 'Rise of the Defiler';
            case self::ZONE_LARISSPAVILION:
                return 'Lariss Pavilion';
            case self::ZONE_WOODPAWHILLS:
                return 'Woodpaw Hills';
            case self::ZONE_WOODPAWDEN:
                return 'Woodpaw Den';
            case self::ZONE_VERDANTISRIVER:
                return 'Verdantis River';
            case self::ZONE_RUINSOFISILDIEN:
                return 'Ruins of Isildien';
            case self::ZONE_GRIMTOTEMPOST:
                return 'Grimtotem Post';
            case self::ZONE_CAMPAPARAJE:
                return 'Camp Aparaje';
            case self::ZONE_MALAKAJIN:
                return 'Malaka\'jin';
            case self::ZONE_BOULDERSLIDERAVINE:
                return 'Boulderslide Ravine';
            case self::ZONE_SISHIRCANYON:
                return 'Sishir Canyon';
            case self::ZONE_DIREMAUL:
                return 'Dire Maul';
            case self::ZONE_DEADWINDRAVINE:
                return 'Deadwind Ravine';
            case self::ZONE_DIAMONDHEADRIVER:
                return 'Diamondhead River';
            case self::ZONE_ARIDENSCAMP:
                return 'Ariden\'s Camp';
            case self::ZONE_THEVICE:
                return 'The Vice';
            case self::ZONE_KARAZHAN:
                return 'Karazhan';
            case self::ZONE_MORGANSPLOT:
                return 'Morgan\'s Plot';
            case self::ZONE_ALTERACVALLEY:
                return 'Alterac Valley';
            case self::ZONE_SCRABBLESCREWSCAMP:
                return 'Scrabblescrew\'s Camp';
            case self::ZONE_JADEFIRERUN:
                return 'Jadefire Run';
            case self::ZONE_THONDRORILRIVER:
                return 'Thondroril River';
            case self::ZONE_LAKEMERELDAR:
                return 'Lake Mereldar';
            case self::ZONE_PESTILENTSCAR:
                return 'Pestilent Scar';
            case self::ZONE_THEINFECTISSCAR:
                return 'The Infectis Scar';
            case self::ZONE_BLACKWOODLAKE:
                return 'Blackwood Lake';
            case self::ZONE_EASTWALLGATE:
                return 'Eastwall Gate';
            case self::ZONE_TERRORWEBTUNNEL:
                return 'Terrorweb Tunnel';
            case self::ZONE_TERRORDALE:
                return 'Terrordale';
            case self::ZONE_KARGATHIAKEEP:
                return 'Kargathia Keep';
            case self::ZONE_VALLEYOFBONES:
                return 'Valley of Bones';
            case self::ZONE_BLACKWINGLAIR:
                return 'Blackwing Lair';
            case self::ZONE_DEADMANSCROSSING:
                return 'Deadman\'s Crossing';
            case self::ZONE_MOLTENCORE:
                return 'Molten Core';
            case self::ZONE_THESCARABWALL:
                return 'The Scarab Wall';
            case self::ZONE_SOUTHWINDVILLAGE:
                return 'Southwind Village';
            case self::ZONE_TWILIGHTBASECAMP:
                return 'Twilight Base Camp';
            case self::ZONE_THECRYSTALVALE:
                return 'The Crystal Vale';
            case self::ZONE_THESCARABDAIS:
                return 'The Scarab Dais';
            case self::ZONE_HIVEASHI:
                return 'Hive\'Ashi';
            case self::ZONE_HIVEZORA:
                return 'Hive\'Zora';
            case self::ZONE_HIVEREGAL:
                return 'Hive\'Regal';
            case self::ZONE_SHRINEOFTHEFALLENWARRIOR:
                return 'Shrine of the Fallen Warrior';
            case self::ZONE_THEMASTERSCELLAR:
                return 'The Master\'s Cellar';
            case self::ZONE_THERUMBLECAGE:
                return 'The Rumble Cage';
            case self::ZONE_CHUNKTEST:
                return 'Chunk Test';
            case self::ZONE_ZORAMGAROUTPOST:
                return 'Zoram\'gar Outpost';
            case self::ZONE_HALLOFLEGENDS:
                return 'Hall of Legends';
            case self::ZONE_CHAMPIONSHALL:
                return 'Champions\' Hall';
            case self::ZONE_GROSHGOKCOMPOUND:
                return 'Grosh\'gok Compound';
            case self::ZONE_SLEEPINGGORGE:
                return 'Sleeping Gorge';
            case self::ZONE_IRONDEEPMINE:
                return 'Irondeep Mine';
            case self::ZONE_STONEHEARTHOUTPOST:
                return 'Stonehearth Outpost';
            case self::ZONE_DUNBALDAR:
                return 'Dun Baldar';
            case self::ZONE_ICEWINGPASS:
                return 'Icewing Pass';
            case self::ZONE_FROSTWOLFVILLAGE:
                return 'Frostwolf Village';
            case self::ZONE_TOWERPOINT:
                return 'Tower Point';
            case self::ZONE_COLDTOOTHMINE:
                return 'Coldtooth Mine';
            case self::ZONE_WINTERAXHOLD:
                return 'Winterax Hold';
            case self::ZONE_ICEBLOODGARRISON:
                return 'Iceblood Garrison';
            case self::ZONE_FROSTWOLFKEEP:
                return 'Frostwolf Keep';
            case self::ZONE_TORKRENFARM:
                return 'Tor\'kren Farm';
            case self::ZONE_FROSTDAGGERPASS:
                return 'Frost Dagger Pass';
            case self::ZONE_IRONSTONECAMP:
                return 'Ironstone Camp';
            case self::ZONE_WEAZELSCRATER:
                return 'Weazel\'s Crater';
            case self::ZONE_TAHONDARUINS:
                return 'Tahonda Ruins';
            case self::ZONE_FIELDOFSTRIFE:
                return 'Field of Strife';
            case self::ZONE_ICEWINGCAVERN:
                return 'Icewing Cavern';
            case self::ZONE_VALORSREST:
                return 'Valor\'s Rest';
            case self::ZONE_THESWARMINGPILLAR:
                return 'The Swarming Pillar';
            case self::ZONE_TWILIGHTPOST:
                return 'Twilight Post';
            case self::ZONE_TWILIGHTOUTPOST:
                return 'Twilight Outpost';
            case self::ZONE_RAVAGEDTWILIGHTCAMP:
                return 'Ravaged Twilight Camp';
            case self::ZONE_SHALZARUSLAIR:
                return 'Shalzaru\'s Lair';
            case self::ZONE_TALRENDISPOINT:
                return 'Talrendis Point';
            case self::ZONE_RETHRESSSANCTUM:
                return 'Rethress Sanctum';
            case self::ZONE_MOONHORRORDEN:
                return 'Moon Horror Den';
            case self::ZONE_SCALEBEARDSCAVE:
                return 'Scalebeard\'s Cave';
            case self::ZONE_BOULDERSLIDECAVERN:
                return 'Boulderslide Cavern';
            case self::ZONE_WARSONGLABORCAMP:
                return 'Warsong Labor Camp';
            case self::ZONE_CHILLWINDCAMP:
                return 'Chillwind Camp';
            case self::ZONE_THEMAUL:
                return 'The Maul';
            case self::ZONE_BONESOFGRAKKAROND:
                return 'Bones of Grakkarond';
            case self::ZONE_WARSONGGULCH:
                return 'Warsong Gulch';
            case self::ZONE_FROSTWOLFGRAVEYARD:
                return 'Frostwolf Graveyard';
            case self::ZONE_FROSTWOLFPASS:
                return 'Frostwolf Pass';
            case self::ZONE_DUNBALDARPASS:
                return 'Dun Baldar Pass';
            case self::ZONE_ICEBLOODGRAVEYARD:
                return 'Iceblood Graveyard';
            case self::ZONE_SNOWFALLGRAVEYARD:
                return 'Snowfall Graveyard';
            case self::ZONE_STONEHEARTHGRAVEYARD:
                return 'Stonehearth Graveyard';
            case self::ZONE_STORMPIKEGRAVEYARD:
                return 'Stormpike Graveyard';
            case self::ZONE_ICEWINGBUNKER:
                return 'Icewing Bunker';
            case self::ZONE_STONEHEARTHBUNKER:
                return 'Stonehearth Bunker';
            case self::ZONE_WILDPAWRIDGE:
                return 'Wildpaw Ridge';
            case self::ZONE_REVANTUSKVILLAGE:
                return 'Revantusk Village';
            case self::ZONE_ROCKOFDUROTAN:
                return 'Rock of Durotan';
            case self::ZONE_SILVERWINGGROVE:
                return 'Silverwing Grove';
            case self::ZONE_WARSONGLUMBERMILL:
                return 'Warsong Lumber Mill';
            case self::ZONE_SILVERWINGHOLD:
                return 'Silverwing Hold';
            case self::ZONE_WILDPAWCAVERN:
                return 'Wildpaw Cavern';
            case self::ZONE_THEVEILEDCLEFT:
                return 'The Veiled Cleft';
            case self::ZONE_YOJAMBAISLE:
                return 'Yojamba Isle';
            case self::ZONE_ARATHIBASIN:
                return 'Arathi Basin';
            case self::ZONE_THECOIL:
                return 'The Coil';
            case self::ZONE_ALTAROFHIREEK:
                return 'Altar of Hir\'eek';
            case self::ZONE_SHADRAZAAR:
                return 'Shadra\'zaar';
            case self::ZONE_HAKKARIGROUNDS:
                return 'Hakkari Grounds';
            case self::ZONE_NAZEOFSHIRVALLAH:
                return 'Naze of Shirvallah';
            case self::ZONE_TEMPLEOFBETHEKK:
                return 'Temple of Bethekk';
            case self::ZONE_THEBLOODFIREPIT:
                return 'The Bloodfire Pit';
            case self::ZONE_ALTAROFTHEBLOODGOD:
                return 'Altar of the Blood God';
            case self::ZONE_ZANZASRISE:
                return 'Zanza\'s Rise';
            case self::ZONE_EDGEOFMADNESS:
                return 'Edge of Madness';
            case self::ZONE_TROLLBANEHALL:
                return 'Trollbane Hall';
            case self::ZONE_DEFILERSDEN:
                return 'Defiler\'s Den';
            case self::ZONE_PAGLESPOINTE:
                return 'Pagle\'s Pointe';
            case self::ZONE_FARM:
                return 'Farm';
            case self::ZONE_BLACKSMITH:
                return 'Blacksmith';
            case self::ZONE_LUMBERMILL:
                return 'Lumber Mill';
            case self::ZONE_GOLDMINE:
                return 'Gold Mine';
            case self::ZONE_STABLES:
                return 'Stables';
            case self::ZONE_CENARIONHOLD:
                return 'Cenarion Hold';
            case self::ZONE_STAGHELMPOINT:
                return 'Staghelm Point';
            case self::ZONE_BRONZEBEARDENCAMPMENT:
                return 'Bronzebeard Encampment';
            case self::ZONE_AHNQIRAJ:
                return 'Ahn\'Qiraj';
            case self::ZONE_RUINSOFAHNQIRAJ:
                return 'Ruins of Ahn\'Qiraj';
            case self::ZONE_EVERSONGWOODS:
                return 'Eversong Woods';
            case self::ZONE_SUNSTRIDERISLE:
                return 'Sunstrider Isle';
            case self::ZONE_SHRINEOFDATHREMAR:
                return 'Shrine of Dath\'Remar';
            case self::ZONE_GHOSTLANDS:
                return 'Ghostlands';
            case self::ZONE_SCARABTERRACE:
                return 'Scarab Terrace';
            case self::ZONE_GENERALSTERRACE:
                return 'General\'s Terrace';
            case self::ZONE_THERESERVOIR:
                return 'The Reservoir';
            case self::ZONE_THEHATCHERY:
                return 'The Hatchery';
            case self::ZONE_THECOMB:
                return 'The Comb';
            case self::ZONE_WATCHERSTERRACE:
                return 'Watchers\' Terrace';
            case self::ZONE_TWILIGHTSRUN:
                return 'Twilight\'s Run';
            case self::ZONE_ORTELLSHIDEOUT:
                return 'Ortell\'s Hideout';
            case self::ZONE_THENORTHSEA:
                return 'The North Sea';
            case self::ZONE_NAXXRAMAS:
                return 'Naxxramas';
            case self::ZONE_GOLDENSTRAND:
                return 'Golden Strand';
            case self::ZONE_SUNSAILANCHORAGE:
                return 'Sunsail Anchorage';
            case self::ZONE_FAIRBREEZEVILLAGE:
                return 'Fairbreeze Village';
            case self::ZONE_MAGISTERSGATE:
                return 'Magisters Gate';
            case self::ZONE_FARSTRIDERRETREAT:
                return 'Farstrider Retreat';
            case self::ZONE_NORTHSANCTUM:
                return 'North Sanctum';
            case self::ZONE_WESTSANCTUM:
                return 'West Sanctum';
            case self::ZONE_EASTSANCTUM:
                return 'East Sanctum';
            case self::ZONE_SALTHERILSHAVEN:
                return 'Saltheril\'s Haven';
            case self::ZONE_THURONSLIVERY:
                return 'Thuron\'s Livery';
            case self::ZONE_STILLWHISPERPOND:
                return 'Stillwhisper Pond';
            case self::ZONE_THELIVINGWOOD:
                return 'The Living Wood';
            case self::ZONE_AZUREBREEZECOAST:
                return 'Azurebreeze Coast';
            case self::ZONE_LAKEELRENDAR:
                return 'Lake Elrendar';
            case self::ZONE_THESCORCHEDGROVE:
                return 'The Scorched Grove';
            case self::ZONE_ZEBWATHA:
                return 'Zeb\'Watha';
            case self::ZONE_TORWATHA:
                return 'Tor\'Watha';
            case self::ZONE_GATESOFAHNQIRAJ:
                return 'Gates of Ahn\'Qiraj';
            case self::ZONE_DUSKWITHERGROUNDS:
                return 'Duskwither Grounds';
            case self::ZONE_DUSKWITHERSPIRE:
                return 'Duskwither Spire';
            case self::ZONE_THEDEADSCAR:
                return 'The Dead Scar';
            case self::ZONE_HELLFIREPENINSULA:
                return 'Hellfire Peninsula';
            case self::ZONE_THESUNSPIRE:
                return 'The Sunspire';
            case self::ZONE_FALTHRIENACADEMY:
                return 'Falthrien Academy';
            case self::ZONE_RAVENHOLDTMANOR:
                return 'Ravenholdt Manor';
            case self::ZONE_SILVERMOONCITY:
                return 'Silvermoon City';
            case self::ZONE_TRANQUILLIEN:
                return 'Tranquillien';
            case self::ZONE_SUNCROWNVILLAGE:
                return 'Suncrown Village';
            case self::ZONE_GOLDENMISTVILLAGE:
                return 'Goldenmist Village';
            case self::ZONE_WINDRUNNERVILLAGE:
                return 'Windrunner Village';
            case self::ZONE_WINDRUNNERSPIRE:
                return 'Windrunner Spire';
            case self::ZONE_SANCTUMOFTHESUN:
                return 'Sanctum of the Sun';
            case self::ZONE_SANCTUMOFTHEMOON:
                return 'Sanctum of the Moon';
            case self::ZONE_DAWNSTARSPIRE:
                return 'Dawnstar Spire';
            case self::ZONE_FARSTRIDERENCLAVE:
                return 'Farstrider Enclave';
            case self::ZONE_ANDAROTH:
                return 'An\'daroth';
            case self::ZONE_ANTELAS:
                return 'An\'telas';
            case self::ZONE_ANOWYN:
                return 'An\'owyn';
            case self::ZONE_DEATHOLME:
                return 'Deatholme';
            case self::ZONE_BLEEDINGZIGGURAT:
                return 'Bleeding Ziggurat';
            case self::ZONE_HOWLINGZIGGURAT:
                return 'Howling Ziggurat';
            case self::ZONE_SHALANDISISLE:
                return 'Shalandis Isle';
            case self::ZONE_TORYLESTATE:
                return 'Toryl Estate';
            case self::ZONE_UNDERLIGHTMINES:
                return 'Underlight Mines';
            case self::ZONE_ANDILIENESTATE:
                return 'Andilien Estate';
            case self::ZONE_HATCHETHILLS:
                return 'Hatchet Hills';
            case self::ZONE_AMANIPASS:
                return 'Amani Pass';
            case self::ZONE_SUNGRAZEPEAK:
                return 'Sungraze Peak';
            case self::ZONE_AMANICATACOMBS:
                return 'Amani Catacombs';
            case self::ZONE_TOWEROFTHEDAMNED:
                return 'Tower of the Damned';
            case self::ZONE_ZEBSORA:
                return 'Zeb\'Sora';
            case self::ZONE_ELRENDARRIVER:
                return 'Elrendar River';
            case self::ZONE_ZEBTELA:
                return 'Zeb\'Tela';
            case self::ZONE_ZEBNOWA:
                return 'Zeb\'Nowa';
            case self::ZONE_NAGRAND:
                return 'Nagrand';
            case self::ZONE_TEROKKARFOREST:
                return 'Terokkar Forest';
            case self::ZONE_SHADOWMOONVALLEY:
                return 'Shadowmoon Valley';
            case self::ZONE_ZANGARMARSH:
                return 'Zangarmarsh';
            case self::ZONE_BLADESEDGEMOUNTAINS:
                return 'Blade\'s Edge Mountains';
            case self::ZONE_NETHERSTORM:
                return 'Netherstorm';
            case self::ZONE_AZUREMYSTISLE:
                return 'Azuremyst Isle';
            case self::ZONE_BLOODMYSTISLE:
                return 'Bloodmyst Isle';
            case self::ZONE_AMMENVALE:
                return 'Ammen Vale';
            case self::ZONE_CRASHSITE:
                return 'Crash Site';
            case self::ZONE_SILVERLINELAKE:
                return 'Silverline Lake';
            case self::ZONE_NESTLEWOODTHICKET:
                return 'Nestlewood Thicket';
            case self::ZONE_SHADOWRIDGE:
                return 'Shadow Ridge';
            case self::ZONE_SKULKINGROW:
                return 'Skulking Row';
            case self::ZONE_DAWNINGLANE:
                return 'Dawning Lane';
            case self::ZONE_RUINSOFSILVERMOON:
                return 'Ruins of Silvermoon';
            case self::ZONE_FETHSWAY:
                return 'Feth\'s Way';
            case self::ZONE_HELLFIRECITADEL:
                return 'Hellfire Citadel';
            case self::ZONE_THRALLMAR:
                return 'Thrallmar';
            case self::ZONE_REUSE:
                return 'REUSE';
            case self::ZONE_HONORHOLD:
                return 'Honor Hold';
            case self::ZONE_THESTAIROFDESTINY:
                return 'The Stair of Destiny';
            case self::ZONE_TWISTINGNETHER:
                return 'Twisting Nether';
            case self::ZONE_FORGECAMPMAGEDDON:
                return 'Forge Camp: Mageddon';
            case self::ZONE_THEPATHOFGLORY:
                return 'The Path of Glory';
            case self::ZONE_THEGREATFISSURE:
                return 'The Great Fissure';
            case self::ZONE_PLAINOFSHARDS:
                return 'Plain of Shards';
            case self::ZONE_EXPEDITIONARMORY:
                return 'Expedition Armory';
            case self::ZONE_THRONEOFKILJAEDEN:
                return 'Throne of Kil\'jaeden';
            case self::ZONE_FORGECAMPRAGE:
                return 'Forge Camp: Rage';
            case self::ZONE_INVASIONPOINTANNIHILATOR:
                return 'Invasion Point: Annihilator';
            case self::ZONE_BORUNERUINS:
                return 'Borune Ruins';
            case self::ZONE_RUINSOFSHANAAR:
                return 'Ruins of Sha\'naar';
            case self::ZONE_TEMPLEOFTELHAMAT:
                return 'Temple of Telhamat';
            case self::ZONE_POOLSOFAGGONAR:
                return 'Pools of Aggonar';
            case self::ZONE_FALCONWATCH:
                return 'Falcon Watch';
            case self::ZONE_MAGHARPOST:
                return 'Mag\'har Post';
            case self::ZONE_DENOFHAALESH:
                return 'Den of Haal\'esh';
            case self::ZONE_THEEXODAR:
                return 'The Exodar';
            case self::ZONE_ELRENDARFALLS:
                return 'Elrendar Falls';
            case self::ZONE_NESTLEWOODHILLS:
                return 'Nestlewood Hills';
            case self::ZONE_AMMENFIELDS:
                return 'Ammen Fields';
            case self::ZONE_THESACREDGROVE:
                return 'The Sacred Grove';
            case self::ZONE_HELLFIRERAMPARTS:
                return 'Hellfire Ramparts';
            case self::ZONE_EMBERGLADE:
                return 'Emberglade';
            case self::ZONE_CENARIONREFUGE:
                return 'Cenarion Refuge';
            case self::ZONE_MOONWINGDEN:
                return 'Moonwing Den';
            case self::ZONE_PODCLUSTER:
                return 'Pod Cluster';
            case self::ZONE_PODWRECKAGE:
                return 'Pod Wreckage';
            case self::ZONE_TIDESHOLLOW:
                return 'Tides\' Hollow';
            case self::ZONE_WRATHSCALEPOINT:
                return 'Wrathscale Point';
            case self::ZONE_BRISTLELIMBVILLAGE:
                return 'Bristlelimb Village';
            case self::ZONE_STILLPINEHOLD:
                return 'Stillpine Hold';
            case self::ZONE_ODESYUSLANDING:
                return 'Odesyus\' Landing';
            case self::ZONE_VALAARSBERTH:
                return 'Valaar\'s Berth';
            case self::ZONE_SILTINGSHORE:
                return 'Silting Shore';
            case self::ZONE_AZUREWATCH:
                return 'Azure Watch';
            case self::ZONE_GEEZLESCAMP:
                return 'Geezle\'s Camp';
            case self::ZONE_MENAGERIEWRECKAGE:
                return 'Menagerie Wreckage';
            case self::ZONE_TRAITORSCOVE:
                return 'Traitor\'s Cove';
            case self::ZONE_WILDWINDPEAK:
                return 'Wildwind Peak';
            case self::ZONE_WILDWINDPATH:
                return 'Wildwind Path';
            case self::ZONE_ZETHGOR:
                return 'Zeth\'Gor';
            case self::ZONE_BERYLCOAST:
                return 'Beryl Coast';
            case self::ZONE_BLOODWATCH:
                return 'Blood Watch';
            case self::ZONE_BLADEWOOD:
                return 'Bladewood';
            case self::ZONE_THEVECTORCOIL:
                return 'The Vector Coil';
            case self::ZONE_THEWARPPISTON:
                return 'The Warp Piston';
            case self::ZONE_THECRYOCORE:
                return 'The Cryo-Core';
            case self::ZONE_THECRIMSONREACH:
                return 'The Crimson Reach';
            case self::ZONE_WRATHSCALELAIR:
                return 'Wrathscale Lair';
            case self::ZONE_RUINSOFLORETHARAN:
                return 'Ruins of Loreth\'Aran';
            case self::ZONE_NAZZIVIAN:
                return 'Nazzivian';
            case self::ZONE_AXXARIEN:
                return 'Axxarien';
            case self::ZONE_BLACKSILTSHORE:
                return 'Blacksilt Shore';
            case self::ZONE_THEFOULPOOL:
                return 'The Foul Pool';
            case self::ZONE_THEHIDDENREEF:
                return 'The Hidden Reef';
            case self::ZONE_AMBERWEBPASS:
                return 'Amberweb Pass';
            case self::ZONE_WYRMSCARISLAND:
                return 'Wyrmscar Island';
            case self::ZONE_TALONSTAND:
                return 'Talon Stand';
            case self::ZONE_BRISTLELIMBENCLAVE:
                return 'Bristlelimb Enclave';
            case self::ZONE_RAGEFEATHERRIDGE:
                return 'Ragefeather Ridge';
            case self::ZONE_KESSELSCROSSING:
                return 'Kessel\'s Crossing';
            case self::ZONE_TELATHIONSCAMP:
                return 'Tel\'athion\'s Camp';
            case self::ZONE_THEBLOODCURSEDREEF:
                return 'The Bloodcursed Reef';
            case self::ZONE_HYJALPAST:
                return 'Hyjal Past';
            case self::ZONE_HYJALSUMMIT:
                return 'Hyjal Summit';
            case self::ZONE_COILFANGRESERVOIR:
                return 'Coilfang Reservoir';
            case self::ZONE_VINDICATORSREST:
                return 'Vindicator\'s Rest';
            case self::ZONE_BURNINGBLADERUINS:
                return 'Burning Blade Ruins';
            case self::ZONE_CLANWATCH:
                return 'Clan Watch';
            case self::ZONE_BLOODCURSEISLE:
                return 'Bloodcurse Isle';
            case self::ZONE_GARADAR:
                return 'Garadar';
            case self::ZONE_SKYSONGLAKE:
                return 'Skysong Lake';
            case self::ZONE_THRONEOFTHEELEMENTS:
                return 'Throne of the Elements';
            case self::ZONE_LAUGHINGSKULLRUINS:
                return 'Laughing Skull Ruins';
            case self::ZONE_WARMAULHILL:
                return 'Warmaul Hill';
            case self::ZONE_GRUULSLAIR:
                return 'Gruul\'s Lair';
            case self::ZONE_AURENRIDGE:
                return 'Auren Ridge';
            case self::ZONE_AURENFALLS:
                return 'Auren Falls';
            case self::ZONE_LAKESUNSPRING:
                return 'Lake Sunspring';
            case self::ZONE_SUNSPRINGPOST:
                return 'Sunspring Post';
            case self::ZONE_AERISLANDING:
                return 'Aeris Landing';
            case self::ZONE_FORGECAMPFEAR:
                return 'Forge Camp: Fear';
            case self::ZONE_FORGECAMPHATE:
                return 'Forge Camp: Hate';
            case self::ZONE_TELAAR:
                return 'Telaar';
            case self::ZONE_NORTHWINDCLEFT:
                return 'Northwind Cleft';
            case self::ZONE_HALAA:
                return 'Halaa';
            case self::ZONE_SOUTHWINDCLEFT:
                return 'Southwind Cleft';
            case self::ZONE_OSHUGUN:
                return 'Oshu\'gun';
            case self::ZONE_SPIRITFIELDS:
                return 'Spirit Fields';
            case self::ZONE_SHAMANAR:
                return 'Shamanar';
            case self::ZONE_ANCESTRALGROUNDS:
                return 'Ancestral Grounds';
            case self::ZONE_WINDYREEDVILLAGE:
                return 'Windyreed Village';
            case self::ZONE_ELEMENTALPLATEAU:
                return 'Elemental Plateau';
            case self::ZONE_KILSORROWFORTRESS:
                return 'Kil\'sorrow Fortress';
            case self::ZONE_THERINGOFTRIALS:
                return 'The Ring of Trials';
            case self::ZONE_SILVERMYSTISLE:
                return 'Silvermyst Isle';
            case self::ZONE_DAGGERFENVILLAGE:
                return 'Daggerfen Village';
            case self::ZONE_UMBRAFENVILLAGE:
                return 'Umbrafen Village';
            case self::ZONE_FERALFENVILLAGE:
                return 'Feralfen Village';
            case self::ZONE_BLOODSCALEENCLAVE:
                return 'Bloodscale Enclave';
            case self::ZONE_TELREDOR:
                return 'Telredor';
            case self::ZONE_ZABRAJIN:
                return 'Zabra\'jin';
            case self::ZONE_QUAGGRIDGE:
                return 'Quagg Ridge';
            case self::ZONE_THESPAWNINGGLEN:
                return 'The Spawning Glen';
            case self::ZONE_THEDEADMIRE:
                return 'The Dead Mire';
            case self::ZONE_SPOREGGAR:
                return 'Sporeggar';
            case self::ZONE_ANGOROSHGROUNDS:
                return 'Ango\'rosh Grounds';
            case self::ZONE_ANGOROSHSTRONGHOLD:
                return 'Ango\'rosh Stronghold';
            case self::ZONE_FUNGGORCAVERN:
                return 'Funggor Cavern';
            case self::ZONE_SERPENTLAKE:
                return 'Serpent Lake';
            case self::ZONE_THEDRAIN:
                return 'The Drain';
            case self::ZONE_UMBRAFENLAKE:
                return 'Umbrafen Lake';
            case self::ZONE_MARSHLIGHTLAKE:
                return 'Marshlight Lake';
            case self::ZONE_PORTALCLEARING:
                return 'Portal Clearing';
            case self::ZONE_SPOREWINDLAKE:
                return 'Sporewind Lake';
            case self::ZONE_THELAGOON:
                return 'The Lagoon';
            case self::ZONE_BLADESRUN:
                return 'Blades\' Run';
            case self::ZONE_BLADETOOTHCANYON:
                return 'Blade Tooth Canyon';
            case self::ZONE_COMMONSHALL:
                return 'Commons Hall';
            case self::ZONE_DERELICTMANOR:
                return 'Derelict Manor';
            case self::ZONE_HUNTRESSOFTHESUN:
                return 'Huntress of the Sun';
            case self::ZONE_FALCONWINGSQUARE:
                return 'Falconwing Square';
            case self::ZONE_HALAANIBASIN:
                return 'Halaani Basin';
            case self::ZONE_HEWNBOG:
                return 'Hewn Bog';
            case self::ZONE_BOHAMURUINS:
                return 'Boha\'mu Ruins';
            case self::ZONE_THESTADIUM:
                return 'The Stadium';
            case self::ZONE_THEOVERLOOK:
                return 'The Overlook';
            case self::ZONE_BROKENHILL:
                return 'Broken Hill';
            case self::ZONE_MAGHARIPROCESSION:
                return 'Mag\'hari Procession';
            case self::ZONE_NESINGWARYSAFARI:
                return 'Nesingwary Safari';
            case self::ZONE_CENARIONTHICKET:
                return 'Cenarion Thicket';
            case self::ZONE_TUUREM:
                return 'Tuurem';
            case self::ZONE_VEILSHIENOR:
                return 'Veil Shienor';
            case self::ZONE_VEILSKITH:
                return 'Veil Skith';
            case self::ZONE_VEILSHALAS:
                return 'Veil Shalas';
            case self::ZONE_SKETTIS:
                return 'Skettis';
            case self::ZONE_BLACKWINDVALLEY:
                return 'Blackwind Valley';
            case self::ZONE_FIREWINGPOINT:
                return 'Firewing Point';
            case self::ZONE_GRANGOLVARVILLAGE:
                return 'Grangol\'var Village';
            case self::ZONE_STONEBREAKERHOLD:
                return 'Stonebreaker Hold';
            case self::ZONE_ALLERIANSTRONGHOLD:
                return 'Allerian Stronghold';
            case self::ZONE_BONECHEWERRUINS:
                return 'Bonechewer Ruins';
            case self::ZONE_VEILLITHIC:
                return 'Veil Lithic';
            case self::ZONE_OLEMBAS:
                return 'Olembas';
            case self::ZONE_AUCHINDOUN:
                return 'Auchindoun';
            case self::ZONE_VEILRESKK:
                return 'Veil Reskk';
            case self::ZONE_BLACKWINDLAKE:
                return 'Blackwind Lake';
            case self::ZONE_LAKEERENORU:
                return 'Lake Ere\'Noru';
            case self::ZONE_LAKEJORUNE:
                return 'Lake Jorune';
            case self::ZONE_SKETHYLMOUNTAINS:
                return 'Skethyl Mountains';
            case self::ZONE_MISTYRIDGE:
                return 'Misty Ridge';
            case self::ZONE_THEBROKENHILLS:
                return 'The Broken Hills';
            case self::ZONE_THEBARRIERHILLS:
                return 'The Barrier Hills';
            case self::ZONE_THEBONEWASTES:
                return 'The Bone Wastes';
            case self::ZONE_NAGRANDARENA:
                return 'Nagrand Arena';
            case self::ZONE_LAUGHINGSKULLCOURTYARD:
                return 'Laughing Skull Courtyard';
            case self::ZONE_THERINGOFBLOOD:
                return 'The Ring of Blood';
            case self::ZONE_ARENAFLOOR:
                return 'Arena Floor';
            case self::ZONE_BLADESEDGEARENA:
                return 'Blade\'s Edge Arena';
            case self::ZONE_SHATTRATHCITY:
                return 'Shattrath City';
            case self::ZONE_THESHEPHERDSGATE:
                return 'The Shepherd\'s Gate';
            case self::ZONE_TELAARIBASIN:
                return 'Telaari Basin';
            case self::ZONE_ALLIANCEBASE:
                return 'Alliance Base';
            case self::ZONE_HORDEENCAMPMENT:
                return 'Horde Encampment';
            case self::ZONE_NIGHTELFVILLAGE:
                return 'Night Elf Village';
            case self::ZONE_NORDRASSIL:
                return 'Nordrassil';
            case self::ZONE_BLACKTEMPLE:
                return 'Black Temple';
            case self::ZONE_AREA52:
                return 'Area 52';
            case self::ZONE_THEBLOODFURNACE:
                return 'The Blood Furnace';
            case self::ZONE_THESHATTEREDHALLS:
                return 'The Shattered Halls';
            case self::ZONE_THESTEAMVAULT:
                return 'The Steamvault';
            case self::ZONE_THEUNDERBOG:
                return 'The Underbog';
            case self::ZONE_THESLAVEPENS:
                return 'The Slave Pens';
            case self::ZONE_SWAMPRATPOST:
                return 'Swamprat Post';
            case self::ZONE_BLEEDINGHOLLOWRUINS:
                return 'Bleeding Hollow Ruins';
            case self::ZONE_TWINSPIRERUINS:
                return 'Twin Spire Ruins';
            case self::ZONE_THECRUMBLINGWASTE:
                return 'The Crumbling Waste';
            case self::ZONE_MANAFORGEARA:
                return 'Manaforge Ara';
            case self::ZONE_ARKLONRUINS:
                return 'Arklon Ruins';
            case self::ZONE_COSMOWRENCH:
                return 'Cosmowrench';
            case self::ZONE_RUINSOFENKAAT:
                return 'Ruins of Enkaat';
            case self::ZONE_MANAFORGEBNAAR:
                return 'Manaforge B\'naar';
            case self::ZONE_THESCRAPFIELD:
                return 'The Scrap Field';
            case self::ZONE_THEVORTEXFIELDS:
                return 'The Vortex Fields';
            case self::ZONE_THEHEAP:
                return 'The Heap';
            case self::ZONE_MANAFORGECORUU:
                return 'Manaforge Coruu';
            case self::ZONE_THETEMPESTRIFT:
                return 'The Tempest Rift';
            case self::ZONE_KIRINVARVILLAGE:
                return 'Kirin\'Var Village';
            case self::ZONE_THEVIOLETTOWER:
                return 'The Violet Tower';
            case self::ZONE_MANAFORGEDURO:
                return 'Manaforge Duro';
            case self::ZONE_VOIDWINDPLATEAU:
                return 'Voidwind Plateau';
            case self::ZONE_MANAFORGEULTRIS:
                return 'Manaforge Ultris';
            case self::ZONE_CELESTIALRIDGE:
                return 'Celestial Ridge';
            case self::ZONE_THESTORMSPIRE:
                return 'The Stormspire';
            case self::ZONE_FORGEBASEOBLIVION:
                return 'Forge Base: Oblivion';
            case self::ZONE_FORGEBASEGEHENNA:
                return 'Forge Base: Gehenna';
            case self::ZONE_RUINSOFFARAHLON:
                return 'Ruins of Farahlon';
            case self::ZONE_SOCRETHARSSEAT:
                return 'Socrethar\'s Seat';
            case self::ZONE_LEGIONHOLD:
                return 'Legion Hold';
            case self::ZONE_SHADOWMOONVILLAGE:
                return 'Shadowmoon Village';
            case self::ZONE_WILDHAMMERSTRONGHOLD:
                return 'Wildhammer Stronghold';
            case self::ZONE_THEHANDOFGULDAN:
                return 'The Hand of Gul\'dan';
            case self::ZONE_THEFELPITS:
                return 'The Fel Pits';
            case self::ZONE_THEDEATHFORGE:
                return 'The Deathforge';
            case self::ZONE_COILSKARCISTERN:
                return 'Coilskar Cistern';
            case self::ZONE_COILSKARPOINT:
                return 'Coilskar Point';
            case self::ZONE_SUNFIREPOINT:
                return 'Sunfire Point';
            case self::ZONE_ILLIDARIPOINT:
                return 'Illidari Point';
            case self::ZONE_RUINSOFBAARI:
                return 'Ruins of Baa\'ri';
            case self::ZONE_ALTAROFSHATAR:
                return 'Altar of Sha\'tar';
            case self::ZONE_THESTAIROFDOOM:
                return 'The Stair of Doom';
            case self::ZONE_RUINSOFKARABOR:
                return 'Ruins of Karabor';
            case self::ZONE_ATAMALTERRACE:
                return 'Ata\'mal Terrace';
            case self::ZONE_NETHERWINGFIELDS:
                return 'Netherwing Fields';
            case self::ZONE_NETHERWINGLEDGE:
                return 'Netherwing Ledge';
            case self::ZONE_THEHIGHPATH:
                return 'The High Path';
            case self::ZONE_WINDYREEDPASS:
                return 'Windyreed Pass';
            case self::ZONE_ZANGARRIDGE:
                return 'Zangar Ridge';
            case self::ZONE_THETWILIGHTRIDGE:
                return 'The Twilight Ridge';
            case self::ZONE_RAZORTHORNTRAIL:
                return 'Razorthorn Trail';
            case self::ZONE_OREBORHARBORAGE:
                return 'Orebor Harborage';
            case self::ZONE_JAGGEDRIDGE:
                return 'Jagged Ridge';
            case self::ZONE_THUNDERLORDSTRONGHOLD:
                return 'Thunderlord Stronghold';
            case self::ZONE_THELIVINGGROVE:
                return 'The Living Grove';
            case self::ZONE_SYLVANAAR:
                return 'Sylvanaar';
            case self::ZONE_BLADESPIREHOLD:
                return 'Bladespire Hold';
            case self::ZONE_CIRCLEOFBLOOD:
                return 'Circle of Blood';
            case self::ZONE_BLOODMAULOUTPOST:
                return 'Bloodmaul Outpost';
            case self::ZONE_BLOODMAULCAMP:
                return 'Bloodmaul Camp';
            case self::ZONE_DRAENETHYSTMINE:
                return 'Draenethyst Mine';
            case self::ZONE_TROGMASCLAIM:
                return 'Trogma\'s Claim';
            case self::ZONE_BLACKWINGCOVEN:
                return 'Blackwing Coven';
            case self::ZONE_GRISHNATH:
                return 'Grishnath';
            case self::ZONE_VEILLASHH:
                return 'Veil Lashh';
            case self::ZONE_VEILVEKH:
                return 'Veil Vekh';
            case self::ZONE_FORGECAMPTERROR:
                return 'Forge Camp: Terror';
            case self::ZONE_FORGECAMPWRATH:
                return 'Forge Camp: Wrath';
            case self::ZONE_FELSTORMPOINT:
                return 'Felstorm Point';
            case self::ZONE_FORGECAMPANGER:
                return 'Forge Camp: Anger';
            case self::ZONE_THELOWPATH:
                return 'The Low Path';
            case self::ZONE_SHADOWLABYRINTH:
                return 'Shadow Labyrinth';
            case self::ZONE_AUCHENAICRYPTS:
                return 'Auchenai Crypts';
            case self::ZONE_SETHEKKHALLS:
                return 'Sethekk Halls';
            case self::ZONE_MANATOMBS:
                return 'Mana-Tombs';
            case self::ZONE_FELSPARKRAVINE:
                return 'Felspark Ravine';
            case self::ZONE_SHANAARIWASTES:
                return 'Sha\'naari Wastes';
            case self::ZONE_THEWARPFIELDS:
                return 'The Warp Fields';
            case self::ZONE_FALLENSKYRIDGE:
                return 'Fallen Sky Ridge';
            case self::ZONE_HAALESHIGORGE:
                return 'Haal\'eshi Gorge';
            case self::ZONE_STONEWALLCANYON:
                return 'Stonewall Canyon';
            case self::ZONE_THORNFANGHILL:
                return 'Thornfang Hill';
            case self::ZONE_MAGHARGROUNDS:
                return 'Mag\'har Grounds';
            case self::ZONE_VOIDRIDGE:
                return 'Void Ridge';
            case self::ZONE_THEABYSSALSHELF:
                return 'The Abyssal Shelf';
            case self::ZONE_THELEGIONFRONT:
                return 'The Legion Front';
            case self::ZONE_ZULAMAN:
                return 'Zul\'Aman';
            case self::ZONE_SUPPLYCARAVAN:
                return 'Supply Caravan';
            case self::ZONE_REAVERSFALL:
                return 'Reaver\'s Fall';
            case self::ZONE_CENARIONPOST:
                return 'Cenarion Post';
            case self::ZONE_SOUTHERNRAMPART:
                return 'Southern Rampart';
            case self::ZONE_NORTHERNRAMPART:
                return 'Northern Rampart';
            case self::ZONE_GORGAZOUTPOST:
                return 'Gor\'gaz Outpost';
            case self::ZONE_SPINEBREAKERPOST:
                return 'Spinebreaker Post';
            case self::ZONE_THEPATHOFANGUISH:
                return 'The Path of Anguish';
            case self::ZONE_EASTSUPPLYCARAVAN:
                return 'East Supply Caravan';
            case self::ZONE_EXPEDITIONPOINT:
                return 'Expedition Point';
            case self::ZONE_ZEPPELINCRASH:
                return 'Zeppelin Crash';
            case self::ZONE_TESTING:
                return 'Testing';
            case self::ZONE_BLOODSCALEGROUNDS:
                return 'Bloodscale Grounds';
            case self::ZONE_DARKCRESTENCLAVE:
                return 'Darkcrest Enclave';
            case self::ZONE_EYEOFTHESTORM:
                return 'Eye of the Storm';
            case self::ZONE_WARDENSCAGE:
                return 'Warden\'s Cage';
            case self::ZONE_ECLIPSEPOINT:
                return 'Eclipse Point';
            case self::ZONE_ISLEOFTRIBULATIONS:
                return 'Isle of Tribulations';
            case self::ZONE_BLOODMAULRAVINE:
                return 'Bloodmaul Ravine';
            case self::ZONE_DRAGONSEND:
                return 'Dragons\' End';
            case self::ZONE_DAGGERMAWCANYON:
                return 'Daggermaw Canyon';
            case self::ZONE_VEKHAARSTAND:
                return 'Vekhaar Stand';
            case self::ZONE_RUUANWEALD:
                return 'Ruuan Weald';
            case self::ZONE_VEILRUUAN:
                return 'Veil Ruuan';
            case self::ZONE_RAVENSWOOD:
                return 'Raven\'s Wood';
            case self::ZONE_DEATHSDOOR:
                return 'Death\'s Door';
            case self::ZONE_VORTEXPINNACLE:
                return 'Vortex Pinnacle';
            case self::ZONE_RAZORRIDGE:
                return 'Razor Ridge';
            case self::ZONE_RIDGEOFMADNESS:
                return 'Ridge of Madness';
            case self::ZONE_DUSTQUILLRAVINE:
                return 'Dustquill Ravine';
            case self::ZONE_MAGTHERIDONSLAIR:
                return 'Magtheridon\'s Lair';
            case self::ZONE_SUNFURYHOLD:
                return 'Sunfury Hold';
            case self::ZONE_SPINEBREAKERMOUNTAINS:
                return 'Spinebreaker Mountains';
            case self::ZONE_ABANDONEDARMORY:
                return 'Abandoned Armory';
            case self::ZONE_THEBLACKTEMPLE:
                return 'The Black Temple';
            case self::ZONE_DARKCRESTSHORE:
                return 'Darkcrest Shore';
            case self::ZONE_TEMPESTKEEP:
                return 'Tempest Keep';
            case self::ZONE_MOKNATHALVILLAGE:
                return 'Mok\'Nathal Village';
            case self::ZONE_THEARCATRAZ:
                return 'The Arcatraz';
            case self::ZONE_THEBOTANICA:
                return 'The Botanica';
            case self::ZONE_THEMECHANAR:
                return 'The Mechanar';
            case self::ZONE_NETHERSTONE:
                return 'Netherstone';
            case self::ZONE_MIDREALMPOST:
                return 'Midrealm Post';
            case self::ZONE_TULUMANSLANDING:
                return 'Tuluman\'s Landing';
            case self::ZONE_PROTECTORATEWATCHPOST:
                return 'Protectorate Watch Post';
            case self::ZONE_CIRCLEOFBLOODARENA:
                return 'Circle of Blood Arena';
            case self::ZONE_ELRENDARCROSSING:
                return 'Elrendar Crossing';
            case self::ZONE_AMMENFORD:
                return 'Ammen Ford';
            case self::ZONE_RAZORTHORNSHELF:
                return 'Razorthorn Shelf';
            case self::ZONE_SILMYRLAKE:
                return 'Silmyr Lake';
            case self::ZONE_RAASTOKGLADE:
                return 'Raastok Glade';
            case self::ZONE_THALASSIANPASS:
                return 'Thalassian Pass';
            case self::ZONE_CHURNINGGULCH:
                return 'Churning Gulch';
            case self::ZONE_BROKENWILDS:
                return 'Broken Wilds';
            case self::ZONE_BASHIRLANDING:
                return 'Bash\'ir Landing';
            case self::ZONE_CRYSTALSPINE:
                return 'Crystal Spine';
            case self::ZONE_SKALD:
                return 'Skald';
            case self::ZONE_BLADEDGULCH:
                return 'Bladed Gulch';
            case self::ZONE_GYROPLANKBRIDGE:
                return 'Gyro-Plank Bridge';
            case self::ZONE_MAGETOWER:
                return 'Mage Tower';
            case self::ZONE_BLOODELFTOWER:
                return 'Blood Elf Tower';
            case self::ZONE_DRAENEIRUINS:
                return 'Draenei Ruins';
            case self::ZONE_FELREAVERRUINS:
                return 'Fel Reaver Ruins';
            case self::ZONE_THEPROVINGGROUNDS:
                return 'The Proving Grounds';
            case self::ZONE_ECODOMEFARFIELD:
                return 'Eco-Dome Farfield';
            case self::ZONE_ECODOMESKYPERCH:
                return 'Eco-Dome Skyperch';
            case self::ZONE_ECODOMESUTHERON:
                return 'Eco-Dome Sutheron';
            case self::ZONE_ECODOMEMIDREALM:
                return 'Eco-Dome Midrealm';
            case self::ZONE_ETHEREUMSTAGINGGROUNDS:
                return 'Ethereum Staging Grounds';
            case self::ZONE_CHAPELYARD:
                return 'Chapel Yard';
            case self::ZONE_ACCESSSHAFTZEON:
                return 'Access Shaft Zeon';
            case self::ZONE_TRELLEUMMINE:
                return 'Trelleum Mine';
            case self::ZONE_INVASIONPOINTDESTROYER:
                return 'Invasion Point: Destroyer';
            case self::ZONE_CAMPOFBOOM:
                return 'Camp of Boom';
            case self::ZONE_SPINEBREAKERPASS:
                return 'Spinebreaker Pass';
            case self::ZONE_NETHERWEBRIDGE:
                return 'Netherweb Ridge';
            case self::ZONE_DERELICTCARAVAN:
                return 'Derelict Caravan';
            case self::ZONE_REFUGEECARAVAN:
                return 'Refugee Caravan';
            case self::ZONE_SHADOWTOMB:
                return 'Shadow Tomb';
            case self::ZONE_VEILRHAZE:
                return 'Veil Rhaze';
            case self::ZONE_TOMBOFLIGHTS:
                return 'Tomb of Lights';
            case self::ZONE_CARRIONHILL:
                return 'Carrion Hill';
            case self::ZONE_WRITHINGMOUND:
                return 'Writhing Mound';
            case self::ZONE_RINGOFOBSERVANCE:
                return 'Ring of Observance';
            case self::ZONE_AUCHENAIGROUNDS:
                return 'Auchenai Grounds';
            case self::ZONE_CENARIONWATCHPOST:
                return 'Cenarion Watchpost';
            case self::ZONE_ALDORRISE:
                return 'Aldor Rise';
            case self::ZONE_TERRACEOFLIGHT:
                return 'Terrace of Light';
            case self::ZONE_SCRYERSTIER:
                return 'Scryer\'s Tier';
            case self::ZONE_LOWERCITY:
                return 'Lower City';
            case self::ZONE_INVASIONPOINTOVERLORD:
                return 'Invasion Point: Overlord';
            case self::ZONE_ALLERIANPOST:
                return 'Allerian Post';
            case self::ZONE_STONEBREAKERCAMP:
                return 'Stonebreaker Camp';
            case self::ZONE_BOULDERMOK:
                return 'Boulder\'mok';
            case self::ZONE_CURSEDHOLLOW:
                return 'Cursed Hollow';
            case self::ZONE_THEBLOODWASH:
                return 'The Bloodwash';
            case self::ZONE_VERIDIANPOINT:
                return 'Veridian Point';
            case self::ZONE_MIDDENVALE:
                return 'Middenvale';
            case self::ZONE_THELOSTFOLD:
                return 'The Lost Fold';
            case self::ZONE_MYSTWOOD:
                return 'Mystwood';
            case self::ZONE_TRANQUILSHORE:
                return 'Tranquil Shore';
            case self::ZONE_GOLDENBOUGHPASS:
                return 'Goldenbough Pass';
            case self::ZONE_RUNESTONEFALITHAS:
                return 'Runestone Falithas';
            case self::ZONE_RUNESTONESHANDOR:
                return 'Runestone Shan\'dor';
            case self::ZONE_FAIRBRIDGESTRAND:
                return 'Fairbridge Strand';
            case self::ZONE_MOONGRAZEWOODS:
                return 'Moongraze Woods';
            case self::ZONE_TOSHLEYSSTATION:
                return 'Toshley\'s Station';
            case self::ZONE_SINGINGRIDGE:
                return 'Singing Ridge';
            case self::ZONE_SHATTERPOINT:
                return 'Shatter Point';
            case self::ZONE_ARKLONISRIDGE:
                return 'Arklonis Ridge';
            case self::ZONE_BLADESPIREOUTPOST:
                return 'Bladespire Outpost';
            case self::ZONE_NORTHMAULTOWER:
                return 'Northmaul Tower';
            case self::ZONE_SOUTHMAULTOWER:
                return 'Southmaul Tower';
            case self::ZONE_SHATTEREDPLAINS:
                return 'Shattered Plains';
            case self::ZONE_ORONOKSFARM:
                return 'Oronok\'s Farm';
            case self::ZONE_THEALTAROFDAMNATION:
                return 'The Altar of Damnation';
            case self::ZONE_THEPATHOFCONQUEST:
                return 'The Path of Conquest';
            case self::ZONE_ECLIPSIONFIELDS:
                return 'Eclipsion Fields';
            case self::ZONE_BLADESPIREGROUNDS:
                return 'Bladespire Grounds';
            case self::ZONE_SKETHLONBASECAMP:
                return 'Sketh\'lon Base Camp';
            case self::ZONE_SKETHLONWRECKAGE:
                return 'Sketh\'lon Wreckage';
            case self::ZONE_TOWNSQUARE:
                return 'Town Square';
            case self::ZONE_WIZARDROW:
                return 'Wizard Row';
            case self::ZONE_DEATHFORGETOWER:
                return 'Deathforge Tower';
            case self::ZONE_SLAGWATCH:
                return 'Slag Watch';
            case self::ZONE_SANCTUMOFTHESTARS:
                return 'Sanctum of the Stars';
            case self::ZONE_DRAGONMAWFORTRESS:
                return 'Dragonmaw Fortress';
            case self::ZONE_THEFETIDPOOL:
                return 'The Fetid Pool';
            case self::ZONE_RAZAANSLANDING:
                return 'Razaan\'s Landing';
            case self::ZONE_INVASIONPOINTCATACLYSM:
                return 'Invasion Point: Cataclysm';
            case self::ZONE_THEALTAROFSHADOWS:
                return 'The Altar of Shadows';
            case self::ZONE_NETHERWINGPASS:
                return 'Netherwing Pass';
            case self::ZONE_WAYNESREFUGE:
                return 'Wayne\'s Refuge';
            case self::ZONE_THESCALDINGPOOLS:
                return 'The Scalding Pools';
            case self::ZONE_BRIANANDPATTEST:
                return 'Brian and Pat Test';
            case self::ZONE_MAGMAFIELDS:
                return 'Magma Fields';
            case self::ZONE_CRIMSONWATCH:
                return 'Crimson Watch';
            case self::ZONE_EVERGROVE:
                return 'Evergrove';
            case self::ZONE_WYRMSKULLBRIDGE:
                return 'Wyrmskull Bridge';
            case self::ZONE_SCALEWINGSHELF:
                return 'Scalewing Shelf';
            case self::ZONE_WYRMSKULLTUNNEL:
                return 'Wyrmskull Tunnel';
            case self::ZONE_HELLFIREBASIN:
                return 'Hellfire Basin';
            case self::ZONE_THESHADOWSTAIR:
                return 'The Shadow Stair';
            case self::ZONE_SHATARIOUTPOST:
                return 'Sha\'tari Outpost';
            default:
                return 'Unspecified';
        }
    }
}
