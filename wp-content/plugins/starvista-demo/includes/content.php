<?php
/**
 * Sample entertainment content. Original fictional stories only.
 *
 * @package StarVista_Demo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function starvista_demo_body( $lede, $points ) {
	$paras  = '<p>' . esc_html( $lede ) . '</p>';
	$paras .= '<p>This is original sample reporting written for a WordPress internship assignment. Names, titles, and events are fictional placeholders so the site can be demonstrated without copying copyrighted entertainment coverage.</p>';
	foreach ( $points as $point ) {
		$paras .= '<p>' . esc_html( $point ) . '</p>';
	}
	$paras .= '<p>Editors will replace these stories with real reporting before any public launch. Until then, every card, permalink, and category archive is wired to an actual WordPress post so the homepage behaves like a live newsroom.</p>';
	return $paras;
}

function starvista_demo_posts() {
	return array(
		array(
			'title'      => 'Midnight Premiere Lights Up the Season’s Most Talked-About Ensemble Drama',
			'slug'       => 'midnight-premiere-ensemble-drama',
			'cats'       => array( 'latest', 'entertainment', 'bollywood' ),
			'excerpt'    => 'A rain-soaked red carpet, a surprise musical cue, and a cast that actually lingered with fans.',
			'rating'     => '',
			'video'      => false,
			'author'     => 'maya.rao',
			'content'    => starvista_demo_body(
				'The first public screening of the ensemble drama “Harbour Lights” turned into an unofficial festival of umbrellas, fan chants, and a closing-credits needle-drop nobody had leaked.',
				array(
					'Cast members walked a shortened carpet and spent more time in the photo pit than on staged interviews.',
					'Studio publicists confirmed a nationwide expansion two weeks after the limited opening.',
					'Fashion desks noted a run of monochrome tailoring rather than the usual metallic crush.',
				)
			),
		),
		array(
			'title'      => 'Top Celebrity Looks That Stole the Spotlight This Week',
			'slug'       => 'top-celebrity-looks-this-week',
			'cats'       => array( 'latest', 'celebrity-style', 'fashion' ),
			'excerpt'    => 'Sculptural coats, vintage embroidery, and one unforgettable silver sari moment.',
			'author'     => 'leah.dsouza',
			'content'    => starvista_demo_body(
				'From airport lounge-to-runway dressing to a charity gala in the city, this week’s best looks were less about logos and more about silhouette.',
				array(
					'A structured ivory coat with a cropped hem became the most screenshotted departure look.',
					'Stylists we spoke to pointed to a return of hand embroidery on evening suiting.',
					'Street-style photographers camped outside two private dinners and still went home happy.',
				)
			),
		),
		array(
			'title'      => 'The Archive Gown Making a Quiet Comeback on Every Carpet',
			'slug'       => 'archive-gown-comeback',
			'cats'       => array( 'celebrity-style', 'fashion' ),
			'excerpt'    => 'Why 1990s atelier pieces are outperforming brand-new couture in the photo pit.',
			'author'     => 'leah.dsouza',
			'content'    => starvista_demo_body(
				'Vintage coordinators are the new power brokers. Three publicists independently told StarVista they now budget for archive loans the way they once budgeted for jewelry.',
				array(
					'The most requested silhouette is a bias-cut column with a modest neckline.',
					'Insurance paperwork, not availability, is the real bottleneck.',
				)
			),
		),
		array(
			'title'      => 'Airport Style, Elevated: Travel Looks That Still Photograph Well at 6 a.m.',
			'slug'       => 'airport-style-elevated',
			'cats'       => array( 'celebrity-style', 'fashion' ),
			'excerpt'    => 'Knit sets, longline blazers, and sneakers that do not look like a sponsorship.',
			'author'     => 'leah.dsouza',
			'content'    => starvista_demo_body(
				'Early-morning departures used to be a styling afterthought. Not anymore — cameras at terminals are as relentless as premiere pits.',
				array(
					'Neutral palettes still win, but a single saturated accessory is back.',
					'Oversized sunglasses remain undefeated.',
				)
			),
		),
		array(
			'title'      => 'Men’s Red Carpet Tailoring Gets Sharper — and a Lot Less Safe',
			'slug'       => 'mens-red-carpet-tailoring',
			'cats'       => array( 'celebrity-style', 'fashion' ),
			'excerpt'    => 'Wider lapels, unexpected brooches, and the end of the timid tuxedo.',
			'author'     => 'arjun.mehta',
			'content'    => starvista_demo_body(
				'Menswear on the carpet is finally catching up with the risk-taking that womenswear has treated as default.',
				array(
					'Jewel-tone dinner jackets outperformed classic black in last month’s openings.',
					'Stylists cited a handful of independent Indian ateliers as the season’s quiet winners.',
				)
			),
		),
		array(
			'title'      => 'How One Stylist Built a Week of Looks From a Single Capsule Wardrobe',
			'slug'       => 'stylist-capsule-wardrobe',
			'cats'       => array( 'celebrity-style', 'fashion', 'lifestyle' ),
			'excerpt'    => 'Five events, twelve pieces, zero panic swaps at midnight.',
			'author'     => 'leah.dsouza',
			'content'    => starvista_demo_body(
				'A working stylist walked us through a real week of fittings using a tightly edited rack instead of a truck of options.',
				array(
					'The secret was repeatable bases: two trousers, one sari blouse, one evening skirt.',
					'Jewelry did the storytelling so garments could stay modular.',
				)
			),
		),
		array(
			'title'      => 'On Set With the Crew Behind This Season’s Breakout Music Video',
			'slug'       => 'on-set-breakout-music-video',
			'cats'       => array( 'videos', 'entertainment', 'latest' ),
			'excerpt'    => 'One warehouse, two nights, and a chorus that was recut at 4 a.m.',
			'author'     => 'kabir.shah',
			'video'      => true,
			'content'    => starvista_demo_body(
				'StarVista spent 36 hours with the team shooting “Glass Orchard,” a video that already has stylists and choreographers quoting it in fittings.',
				array(
					'The director blocked the final shot as a single take after the crane failed.',
					'Wardrobe used recycled festival silks dyed overnight in a parking lot.',
				)
			),
		),
		array(
			'title'      => 'Trailer Breakdown: Why the New Spy Thriller’s Cold Open Already Works',
			'slug'       => 'trailer-breakdown-spy-thriller',
			'cats'       => array( 'videos', 'entertainment', 'hollywood' ),
			'excerpt'    => 'A 48-second prologue, almost no dialogue, and a very expensive silence.',
			'author'     => 'nina.kapoor',
			'video'      => true,
			'content'    => starvista_demo_body(
				'The first official trailer for “North Line” leads with atmosphere instead of a title card, and that choice is doing a lot of work.',
				array(
					'Editors trimmed three quips that tested well but flattened the tension.',
					'Sound design, not CGI, is the flex.',
				)
			),
		),
		array(
			'title'      => 'Dance Rehearsal Diaries: Building a Finale Number in Five Days',
			'slug'       => 'dance-rehearsal-diaries',
			'cats'       => array( 'videos', 'entertainment', 'bollywood' ),
			'excerpt'    => 'Blisters, backup formations, and a chorus line that refused to simplify.',
			'author'     => 'kabir.shah',
			'video'      => true,
			'content'    => starvista_demo_body(
				'We filmed a rehearsal room as a film crew rebuilt a finale after a lead dancer’s injury.',
				array(
					'Choreography was rewritten around stillness rather than bigger kicks.',
					'The take that shipped was take nineteen.',
				)
			),
		),
		array(
			'title'      => 'Festival Diary: Three Minutes With the Breakout Director of the Year',
			'slug'       => 'festival-diary-breakout-director',
			'cats'       => array( 'videos', 'entertainment' ),
			'excerpt'    => 'A handheld conversation between screenings, espresso, and a lost lanyard.',
			'author'     => 'nina.kapoor',
			'video'      => true,
			'content'    => starvista_demo_body(
				'Catching filmmakers between premieres is a sport. This one talked about night shoots, aunties as test audiences, and refusing a studio ending.',
				array(
					'The film was financed in three countries and cut in a spare bedroom.',
					'A theatrical window is still being negotiated.',
				)
			),
		),
		array(
			'title'      => 'Exclusive: Inside the Variety Hour That’s Quietly Dominating Late Night',
			'slug'       => 'inside-variety-hour-late-night',
			'cats'       => array( 'videos', 'tv', 'entertainment' ),
			'excerpt'    => 'House bands, surprise cooks, and a writing room that still uses index cards.',
			'author'     => 'priya.nair',
			'video'      => true,
			'content'    => starvista_demo_body(
				'The weekly variety hour “After Glow” looks effortless on air and chaotic at 5 p.m. We were there for both.',
				array(
					'Cue cards are banned; hosts memorize cold opens.',
					'Guest bookings now include athletes and novelists, not only actors.',
				)
			),
		),
		array(
			'title'      => 'How a Micro-Budget Short Became This Month’s Most Shared Clip',
			'slug'       => 'micro-budget-short-shared-clip',
			'cats'       => array( 'videos', 'lifestyle' ),
			'excerpt'    => 'Twelve people, one borrowed lens, and a city rooftop after closing time.',
			'author'     => 'kabir.shah',
			'video'      => true,
			'content'    => starvista_demo_body(
				'Not every viral clip needs a studio machine. This one needed patience, a generator, and a neighbor who stopped complaining.',
				array(
					'The crew shot for nine nights to catch the right skyline haze.',
					'Music was licensed from a college jazz quartet.',
				)
			),
		),
		array(
			'title'      => 'Harbour Lights Review: An Ensemble Drama That Earns Its Quiet Ending',
			'slug'       => 'harbour-lights-review',
			'cats'       => array( 'movie-reviews', 'entertainment', 'latest' ),
			'excerpt'    => 'Patient, funny in the corners, and finally interested in people rather than plot machinery.',
			'author'     => 'arjun.mehta',
			'rating'     => '4.2',
			'content'    => starvista_demo_body(
				'“Harbour Lights” is the rare studio drama that trusts silences. It is also the rare one that remembers to be entertaining.',
				array(
					'Performances are lived-in rather than showy, which will divide opening-weekend crowds.',
					'The last twenty minutes take a risk that mostly pays off.',
					'See it on a big screen if you can; the sound mix is doing invisible work.',
				)
			),
		),
		array(
			'title'      => 'North Line Review: A Spy Thriller With Style to Spare and a Soft Middle',
			'slug'       => 'north-line-review',
			'cats'       => array( 'movie-reviews', 'hollywood' ),
			'excerpt'    => 'Gorgeous night photography, a sharp lead turn, and one twist too many.',
			'author'     => 'nina.kapoor',
			'rating'     => '3.6',
			'content'    => starvista_demo_body(
				'“North Line” looks like a million dollars at dusk and slightly less sure of itself at noon.',
				array(
					'Action geography is unusually clear.',
					'The third-act explanation dump should have stayed on the cutting-room floor.',
				)
			),
		),
		array(
			'title'      => 'Saffron Circuit Review: A Sports Film That Actually Sweats',
			'slug'       => 'saffron-circuit-review',
			'cats'       => array( 'movie-reviews', 'south' ),
			'excerpt'    => 'Training montages with dirt under the nails and a coach who is not a slogan machine.',
			'author'     => 'maya.rao',
			'rating'     => '4.0',
			'content'    => starvista_demo_body(
				'Most sports movies tell you winning is about heart. “Saffron Circuit” is more interested in footwork, funding, and family logistics.',
				array(
					'The lead performance is physically specific and emotionally unforced.',
					'A mid-film setback is staged with unusual honesty.',
				)
			),
		),
		array(
			'title'      => '5 Upcoming Studio Films Everyone Is Talking About',
			'slug'       => 'five-upcoming-studio-films',
			'cats'       => array( 'bollywood', 'entertainment', 'latest' ),
			'excerpt'    => 'A courtroom musical, a monsoon heist, and a biopic that may actually be ready.',
			'author'     => 'maya.rao',
			'content'    => starvista_demo_body(
				'Festival chatter is one thing. These five titles have dates, stills, and producers willing to go on the record.',
				array(
					'Two of them are already in the sound mix.',
					'One still does not have a locked ending, which everyone involved claims is “intentional.”',
				)
			),
		),
		array(
			'title'      => 'Box Office Notebook: Why Mid-Budget Dramas Are Suddenly Booking Screens',
			'slug'       => 'box-office-mid-budget-dramas',
			'cats'       => array( 'bollywood', 'entertainment' ),
			'excerpt'    => 'Holdover strength, not opening-day fireworks, is rewriting the calendar.',
			'author'     => 'arjun.mehta',
			'content'    => starvista_demo_body(
				'Exhibitors who spent two years chasing event films are now quietly protecting screens for word-of-mouth titles.',
				array(
					'Weekday occupancy is the real story, not Friday memes.',
					'Regional dubs are being planned earlier in the cycle.',
				)
			),
		),
		array(
			'title'      => 'A Music Composer Explains the Hook You Cannot Stop Humming',
			'slug'       => 'composer-explains-the-hook',
			'cats'       => array( 'bollywood', 'entertainment' ),
			'excerpt'    => 'Four notes, one delayed tabla, and a chorus that arrives late on purpose.',
			'author'     => 'priya.nair',
			'content'    => starvista_demo_body(
				'We sat with a film composer as they walked through the demo that became this quarter’s inescapable motif.',
				array(
					'The first version was twice as fast.',
					'Lyrics were rewritten after a table read, not a focus group.',
				)
			),
		),
		array(
			'title'      => 'New Hollywood Releases You Should Add to Your Watchlist',
			'slug'       => 'hollywood-watchlist-this-month',
			'cats'       => array( 'hollywood', 'entertainment', 'latest' ),
			'excerpt'    => 'A courtroom caper, a quiet sci-fi, and a documentary that feels like a thriller.',
			'author'     => 'nina.kapoor',
			'content'    => starvista_demo_body(
				'Not everything arriving this month needs a midnight screening. Some of it just needs a free evening and decent speakers.',
				array(
					'The documentary is the one friends will text you about.',
					'Skip the algorithm row labeled “Because you watched.” Make your own list.',
				)
			),
		),
		array(
			'title'      => 'Why This Year’s Awards Race Already Has a Front-Runner Nobody Predicted',
			'slug'       => 'awards-race-front-runner',
			'cats'       => array( 'hollywood', 'entertainment' ),
			'excerpt'    => 'A supporting turn from a streaming drama is gathering the kind of quotes campaigns cannot buy.',
			'author'     => 'nina.kapoor',
			'content'    => starvista_demo_body(
				'Guild screeners are still in mailers, but the conversation has already shifted toward a performance that premiered with almost no fanfare.',
				array(
					'Publicists are scrambling to book a proper Q and A circuit.',
					'That is usually a tell.',
				)
			),
		),
		array(
			'title'      => 'A Costume Designer on Building a 1970s Newsroom Without Costume-Drama Cosplay',
			'slug'       => 'costume-designer-1970s-newsroom',
			'cats'       => array( 'hollywood', 'fashion' ),
			'excerpt'    => 'Wrong ties, right wrinkles, and extras who were told to sit in their clothes.',
			'author'     => 'leah.dsouza',
			'content'    => starvista_demo_body(
				'Period films often look like mood boards. This one looks like people who got dressed in the dark after a late edit.',
				array(
					'Everything was aged. Nothing was “hero cleaned” between takes.',
					'That choice will either win a craft award or infuriate a certain kind of viewer.',
				)
			),
		),
		array(
			'title'      => 'TV Shows That Are Trending Right Now — and Which Ones Deserve It',
			'slug'       => 'tv-shows-trending-right-now',
			'cats'       => array( 'tv', 'entertainment', 'latest' ),
			'excerpt'    => 'A workplace comedy, a slow-burn mystery, and a reality format that should not work.',
			'author'     => 'priya.nair',
			'content'    => starvista_demo_body(
				'Charts measure noise. This list measures whether a show is actually doing something with your time.',
				array(
					'The mystery series trusts you to keep up, which is rarer than it should be.',
					'The reality format works because the editing is kind without being dull.',
				)
			),
		),
		array(
			'title'      => 'Inside the Writers’ Room That Turned a Failing Sitcom Into a Second-Season Hit',
			'slug'       => 'writers-room-sitcom-turnaround',
			'cats'       => array( 'tv', 'entertainment' ),
			'excerpt'    => 'They fired the catchphrases, hired two novelists, and let the ensemble be awkward.',
			'author'     => 'priya.nair',
			'content'    => starvista_demo_body(
				'Season one was fine. Season two is specific. That gap is where most shows disappear.',
				array(
					'A new showrunner banned plot-reset episodes.',
					'Guest stars now have to change a relationship, not just visit.',
				)
			),
		),
		array(
			'title'      => 'Reality TV’s New Golden Rule: Stop Manufacturing the Villain',
			'slug'       => 'reality-tv-new-golden-rule',
			'cats'       => array( 'tv', 'lifestyle' ),
			'excerpt'    => 'Audiences can smell a frankenbite from the couch. Producers are finally adjusting.',
			'author'     => 'priya.nair',
			'content'    => starvista_demo_body(
				'The most-watched unscripted series this quarter barely edits for conflict. It edits for character.',
				array(
					'That sounds softer. It is actually harder.',
					'Casting, not confessionals, does the work.',
				)
			),
		),
		array(
			'title'      => 'South Cinema Releases To Watch This Month',
			'slug'       => 'south-cinema-releases-this-month',
			'cats'       => array( 'south', 'entertainment', 'latest' ),
			'excerpt'    => 'A rural thriller, a family comedy with actual jokes, and an animated fable.',
			'author'     => 'maya.rao',
			'content'    => starvista_demo_body(
				'The next four weeks are stacked. If you can only see two, start with the thriller and the fable.',
				array(
					'Several titles are arriving with same-week dubbed versions.',
					'That is becoming standard rather than a favor.',
				)
			),
		),
		array(
			'title'      => 'A Cinematographer on Shooting Night Markets Without Making Them Look Like Postcards',
			'slug'       => 'cinematographer-night-markets',
			'cats'       => array( 'south', 'entertainment' ),
			'excerpt'    => 'Practical lights, impatient extras, and a camera that never looks down on the street.',
			'author'     => 'kabir.shah',
			'content'    => starvista_demo_body(
				'Night markets are a visual cliché waiting to happen. This crew treated them as workplaces.',
				array(
					'They mixed LED tubes already on site with a single bounced source.',
					'Faces stayed readable without turning the lane into a showroom.',
				)
			),
		),
		array(
			'title'      => 'How a Regional Studio Built a Franchise Without Diluting the First Film',
			'slug'       => 'regional-studio-franchise',
			'cats'       => array( 'south', 'entertainment' ),
			'excerpt'    => 'Same world, new protagonist, and a producers’ memo that banned origin-story padding.',
			'author'     => 'maya.rao',
			'content'    => starvista_demo_body(
				'Sequels usually explain. This one continues. Audiences noticed.',
				array(
					'Merchandise came after the story, not before.',
					'That order still matters.',
				)
			),
		),
		array(
			'title'      => 'Best Fashion Trends To Try This Season — Without Buying a New Closet',
			'slug'       => 'best-fashion-trends-this-season',
			'cats'       => array( 'fashion', 'lifestyle', 'latest' ),
			'excerpt'    => 'Longer hems, quieter luxury, and color that belongs in daylight.',
			'author'     => 'leah.dsouza',
			'content'    => starvista_demo_body(
				'Trend lists are only useful if they survive a weekday. These do.',
				array(
					'A longer trouser hem changes more outfits than a new logo belt.',
					'If it needs a special hanger, it is not a weekday trend.',
				)
			),
		),
		array(
			'title'      => 'Style Tips From Working Wardrobe Teams, Not Mood Boards',
			'slug'       => 'style-tips-working-wardrobe-teams',
			'cats'       => array( 'fashion' ),
			'excerpt'    => 'Steam, double-sided tape, and the discipline of a backup shirt.',
			'author'     => 'leah.dsouza',
			'content'    => starvista_demo_body(
				'On-set wardrobe departments have no patience for advice that does not survive humidity.',
				array(
					'They swear by a portable steamer and a lint roller more than any “investment piece.”',
					'Fit is still the whole story.',
				)
			),
		),
		array(
			'title'      => 'Fashion News: Independent Ateliers Are Booking Premiere Slots Once Reserved for Conglomerates',
			'slug'       => 'fashion-news-independent-ateliers',
			'cats'       => array( 'fashion', 'celebrity-style' ),
			'excerpt'    => 'Smaller houses, faster fittings, and clients who want a conversation not a lookbook.',
			'author'     => 'arjun.mehta',
			'content'    => starvista_demo_body(
				'A handful of independent studios landed more documented premiere looks this quarter than some global houses.',
				array(
					'Turnaround time is the competitive advantage.',
					'So is actually answering the phone.',
				)
			),
		),
		array(
			'title'      => 'Latest Beauty Trends Making Waves Without a 12-Step Routine',
			'slug'       => 'latest-beauty-trends-making-waves',
			'cats'       => array( 'beauty', 'lifestyle', 'latest' ),
			'excerpt'    => 'Skin tints, brow restraint, and a liner shape that photographs honestly.',
			'author'     => 'anika.bose',
			'content'    => starvista_demo_body(
				'The looks traveling from fittings to pharmacies this month are simpler than the tutorials suggest.',
				array(
					'Makeup artists on two current productions told us they are using fewer products per face, not more.',
					'The camera is sharper; heavy base looks like heavy base.',
				)
			),
		),
		array(
			'title'      => 'A Makeup Artist’s Kit for 14-Hour Call Times',
			'slug'       => 'makeup-artist-kit-call-times',
			'cats'       => array( 'beauty' ),
			'excerpt'    => 'What actually survives heat, catering, and a director who wants “one more.”',
			'author'     => 'anika.bose',
			'content'    => starvista_demo_body(
				'We emptied a working kit onto a folding table. The expensive stuff was not what we expected.',
				array(
					'Setting spray and blotting papers did more than highlighter palettes.',
					'Hygiene habits, not brand names, separated the kits we trusted.',
				)
			),
		),
		array(
			'title'      => 'Hair Notes: Why Softer Texture Is Replacing the High-Gloss Blowout',
			'slug'       => 'hair-softer-texture-replacing-blowout',
			'cats'       => array( 'beauty', 'fashion' ),
			'excerpt'    => 'Movement on the carpet, fewer helmets in the front row.',
			'author'     => 'anika.bose',
			'content'    => starvista_demo_body(
				'Stylists are leaving more of the hair’s actual pattern in the final look. It photographs as confidence, not unfinished work.',
				array(
					'The change started in fittings where wigs were running late.',
					'It stayed because it looked better.',
				)
			),
		),
		array(
			'title'      => 'Skin-Care Desk: Barrier Repair Is the Least Glamorous Trend That Actually Matters',
			'slug'       => 'skincare-barrier-repair',
			'cats'       => array( 'beauty', 'health' ),
			'excerpt'    => 'Fewer acids, more patience, and a dermatologist who banned the word “hack.”',
			'author'     => 'anika.bose',
			'content'    => starvista_demo_body(
				'After a year of aggressive routines circulating in comment sections, clinics are seeing the hangover.',
				array(
					'Most advice here is boring on purpose.',
					'Boring is how skin recovers.',
				)
			),
		),
		array(
			'title'      => 'Health Desk: How Film Crews Are Rethinking Night-Shoot Endurance',
			'slug'       => 'health-night-shoot-endurance',
			'cats'       => array( 'health', 'lifestyle' ),
			'excerpt'    => 'Real meals, real breaks, and a medic who is not just in the call sheet for insurance.',
			'author'     => 'dev.iyer',
			'content'    => starvista_demo_body(
				'A production that wrapped last month built rest into the schedule instead of bragging about surviving without it.',
				array(
					'Injury rates dropped. So did tempers.',
					'Other crews are asking for the template.',
				)
			),
		),
		array(
			'title'      => 'Five Fitness Habits Stunt Teams Wish Desk Workers Would Steal',
			'slug'       => 'fitness-habits-stunt-teams',
			'cats'       => array( 'health' ),
			'excerpt'    => 'Mobility first, ego second, and never skipping the boring warm-up.',
			'author'     => 'dev.iyer',
			'content'    => starvista_demo_body(
				'Stunt coordinators are not impressed by workout selfies. They are impressed by people who can turn their heads.',
				array(
					'Hip mobility and grip strength came up more than marathon medals.',
					'Consistency beat intensity in every conversation.',
				)
			),
		),
		array(
			'title'      => 'Food and Recovery: What Nutritionists Pack for Festival Weeks',
			'slug'       => 'food-recovery-festival-weeks',
			'cats'       => array( 'health', 'lifestyle' ),
			'excerpt'    => 'Protein you can eat standing up and a hard rule about the third espresso.',
			'author'     => 'dev.iyer',
			'content'    => starvista_demo_body(
				'Festival weeks destroy routines. The people who still look awake on day six are not lucky. They packed.',
				array(
					'Electrolytes were mentioned more than superfoods.',
					'Walking between venues counted as training.',
				)
			),
		),
		array(
			'title'      => 'Sleep Science, Translated for People Who Actually Work Late',
			'slug'       => 'sleep-science-late-workers',
			'cats'       => array( 'health' ),
			'excerpt'    => 'Light, temperature, and the myth of catching up on Sundays.',
			'author'     => 'dev.iyer',
			'content'    => starvista_demo_body(
				'You cannot always sleep at midnight. You can still protect the sleep you get.',
				array(
					'A consistent wake time mattered more than a perfect bedtime.',
					'Screens lost to blackout curtains in every expert quote.',
				)
			),
		),
		array(
			'title'      => 'Korean Wave Notebook: The Series Everyone Is Recommending for Completely Different Reasons',
			'slug'       => 'korean-wave-series-recommending',
			'cats'       => array( 'korean', 'tv', 'latest' ),
			'excerpt'    => 'Half the audience calls it a romance. The other half calls it a workplace survival guide.',
			'author'     => 'sora.park',
			'content'    => starvista_demo_body(
				'The new series “Late Office Rain” is being passed around group chats with wildly different captions, which is usually a sign it is doing more than one thing well.',
				array(
					'Costume changes double as character development.',
					'The soundtrack is already living a second life in short-form clips.',
				)
			),
		),
		array(
			'title'      => 'A Conversation About K-Fashion’s Soft Tailoring Moment',
			'slug'       => 'k-fashion-soft-tailoring',
			'cats'       => array( 'korean', 'fashion' ),
			'excerpt'    => 'Relaxed shoulders, precise hems, and color that still reads as quiet.',
			'author'     => 'sora.park',
			'content'    => starvista_demo_body(
				'What is landing from Seoul showrooms this season is less streetwear flash and more wearable architecture.',
				array(
					'Think unlined jackets that still look expensive on camera.',
					'Accessories stayed small on purpose.',
				)
			),
		),
		array(
			'title'      => 'Idol Comeback Week: How a Tight Promo Calendar Still Left Room for Craft',
			'slug'       => 'idol-comeback-week-craft',
			'cats'       => array( 'korean', 'videos' ),
			'excerpt'    => 'Three stages, one title track, and a B-side that may outlive the campaign.',
			'author'     => 'sora.park',
			'video'      => true,
			'content'    => starvista_demo_body(
				'Comeback weeks are industrial. This one still found a way to look handmade in the details.',
				array(
					'Live vocals on the second stage changed the internet conversation overnight.',
					'Choreography credits were unusually specific, and fans noticed.',
				)
			),
		),
		array(
			'title'      => 'Korean Cinema Spotlight: A Quiet Family Film With Festival Momentum',
			'slug'       => 'korean-cinema-family-film',
			'cats'       => array( 'korean', 'movie-reviews' ),
			'excerpt'    => 'No twists, no speeches, and a last shot that trusts the audience.',
			'author'     => 'sora.park',
			'rating'     => '4.4',
			'content'    => starvista_demo_body(
				'Some films announce themselves. This one sits down across from you and waits.',
				array(
					'It will not be a box-office event. It may be the one people remember in December.',
					'That is a different kind of success.',
				)
			),
		),
		array(
			'title'      => 'Lifestyle Edit: Hosting a Screening Night That Does Not Feel Like Homework',
			'slug'       => 'lifestyle-screening-night',
			'cats'       => array( 'lifestyle' ),
			'excerpt'    => 'One film, two snacks that are not chips, and a hard stop before midnight.',
			'author'     => 'priya.nair',
			'content'    => starvista_demo_body(
				'Watching something together is a social skill again. Treat it like one.',
				array(
					'Pick a runtime under two hours unless you really mean it.',
					'Phones in a bowl sounds precious until the first plot twist.',
				)
			),
		),
		array(
			'title'      => 'Weekend Cities: Where Crews Actually Go When a Shoot Wraps Early',
			'slug'       => 'weekend-cities-crews-wrap-early',
			'cats'       => array( 'lifestyle' ),
			'excerpt'    => 'Not the rooftop everyone Instagrams. The diner that stays open for the second-shift wrap.',
			'author'     => 'dev.iyer',
			'content'    => starvista_demo_body(
				'Ask a gaffer where to eat at 1 a.m. You will get a better city guide than any listicle.',
				array(
					'Three cities, three diners, one recurring order: eggs and something fried.',
					'The glamour is in the work, not the afterparty.',
				)
			),
		),
		array(
			'title'      => 'At Home With a Prop Master’s Collection of Almost-Famous Objects',
			'slug'       => 'prop-master-collection',
			'cats'       => array( 'lifestyle', 'entertainment' ),
			'excerpt'    => 'A telephone that rang in two films and a suitcase that has better stamps than we do.',
			'author'     => 'arjun.mehta',
			'content'    => starvista_demo_body(
				'Prop storage is a museum with worse lighting and better stories.',
				array(
					'Nothing is “just a dummy” after it has been in a close-up.',
					'The suitcase remains available for rental, which feels like a crime.',
				)
			),
		),
	);
}

function starvista_demo_authors() {
	return array(
		'maya.rao'    => array( 'Maya Rao', 'maya@example.com', 'Senior entertainment editor covering premieres and studio news.' ),
		'leah.dsouza' => array( 'Leah D’Souza', 'leah@example.com', 'Fashion editor focused on celebrity style and working wardrobes.' ),
		'arjun.mehta' => array( 'Arjun Mehta', 'arjun@example.com', 'Critic and features writer.' ),
		'kabir.shah'  => array( 'Kabir Shah', 'kabir@example.com', 'Video producer and on-set reporter.' ),
		'nina.kapoor' => array( 'Nina Kapoor', 'nina@example.com', 'Hollywood and awards correspondent.' ),
		'priya.nair'  => array( 'Priya Nair', 'priya@example.com', 'Television editor.' ),
		'anika.bose'  => array( 'Anika Bose', 'anika@example.com', 'Beauty editor.' ),
		'dev.iyer'    => array( 'Dev Iyer', 'dev@example.com', 'Health and lifestyle writer.' ),
		'sora.park'   => array( 'Sora Park', 'sora@example.com', 'Korean wave correspondent.' ),
	);
}

function starvista_demo_categories() {
	return array(
		'Latest'           => 'latest',
		'Videos'           => 'videos',
		'Entertainment'    => 'entertainment',
		'Bollywood'        => 'bollywood',
		'Hollywood'        => 'hollywood',
		'TV'               => 'tv',
		'South'            => 'south',
		'Celebrity Style'  => 'celebrity-style',
		'Fashion'          => 'fashion',
		'Health'           => 'health',
		'Beauty'           => 'beauty',
		'Movie Reviews'    => 'movie-reviews',
		'Korean'           => 'korean',
		'Lifestyle'        => 'lifestyle',
	);
}
