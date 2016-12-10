<?php

	class PostController extends IndexController
	{

		public function index()
		{
			include('src/views/post/index.html');
		}

		public function view($postId = 1)
		{
			// need the user id to create post model which will load the posts
			//$model = new PostModel($userId);}
			$stuff = "1";
				$postData = array(
					'description' => 'Mother always told me to avoid the South. Father always told me to avoid the whole damn country altogether. “Go to New York City or Los Angeles, if you must, but go nowhere in between. Those parts are filled with cultists and priests who still worship the old gods.” \nIt was from the position of lying strapped to a slab of rock in the middle of nowhere - Thunderbolt, Georgia - with my voice gone hoarse from screaming for help, while a hooded figured chanted incantations to some foreign god that I decided I really should have listened to them.',
					'name'        => 'Pure Light',
					'author'      => 'Paul Cupido',
					'content'     => 'Mother always told me to avoid the South. Father always told me to avoid the whole damn country altogether. “Go to New York City or Los Angeles, if you must, but go nowhere in between. Those parts are filled with cultists and priests who still worship the old gods.”It was from the position of lying strapped to a slab of rock in the middle of nowhere - Thunderbolt, Georgia - with my voice gone hoarse from screaming for help, while a hooded figured chanted incantations to some foreign god that I decided I really should have listened to them.<br /><br />------------------------<br />“Of the four pillars that form the basis for the study and use of modern magic, the pillar to gain the most notoriety, amongst not only the general population but also the Northern Conclave for the administration and control of magical use, is Umbra Magi or as it is colloquially known: The Dark Arts. This arm of magic ranges from the common offensive magic (so-called Chaos spells) to the less common Alchemy and, which is even less common, Rituals. The last of which should be expressly avoided unless one wishes to summon a demon.” The Magical Practices, Second Edition<br />------------------------<br /><br /><br />I had decided to get the full southern experience this summer by coming to stay with my uncle. He had lived in every state that seceded from the union and, as such, I thought of going out to his farm for the summer as a good form of rebellion against my parents. Part of me was curious, though. Part of me wanted to go just to see the black mages of the Southern Enclave with my own eyes. Did they really raise the dead in the Everglades? Did zombies and spirits rock out in the streets during Mardi gras in New Orleans? What was Dia de los Muertos like? Okay, that was Mexico but still, I could only imagine the dead pretending to be alive and mortal again. I could picture them walking through the streets alongside the living, their decomposed faces mistaken for make-up. Not that mortals would notice any of this but I was a born witch (half-witch technically), it was in my blood to notice the supernatural world because, well, I was from that world. Though even for us, there is strangeness. Especially for me who grew up in the boring, conservative, White and Red-magic obsessed, epicenter of the damn Northern Conclave. I wanted to leave there to discover whether my parents were trying to sour me on the world outside and the other kinds of magic with stupid old wives’ tales. I wanted to go to the middle of the Southern Enclave and see the Black magic for myself, see the heart of darkness beating right in front of me and feel its pulse vibrating through the very air I breathed. Mom and Dad had spent enough time sheltering me in the Conclave, now it was time get out.<br />------------------------<br />Back at the rock, the hood was strafing around me, drawing a summoning circle. When he completed that, my assailant stopped what he was doing and took to rest. Dark ritual or no, this was still Georgia and trouncing around in black formal robes, complete with a golden mask to hide his identity, in the middle of summer was not the smartest thing that he could have done.He kept his back towards me while he set his notebook down and took off his mask, emptying a canteen of water into his mouth before proceeding to do nothing but stand underneath a shady tree for five minutes. Evidently we had reached the waiting part of whatever ritual he was supposed to perform.“Excuse me. Hello?” I said, trying to retain the etiquette that my mom had drilled into me as a child. I could hear her voice now: ‘Remember Shelley, dear, kidnapping is no excuse for bad manners’. The guy wasn’t responding anyway. He looked like he was meditating or something.“Yes, you, ass-hat with the black robes.”  I said, pulling out Dad’s manners. I heard my dad’s voice too: ‘Forget etiquette, just scream your lungs out and get out of dodge.’“If you’re not going to untie me then can you just, you know, hurry up.” I said, sounding like a city dweller.I’m not quite sure how he got me in the first place. I remember going into town for some reason. I remember meeting my cousin for lunch and then leaving to go somewhere else but not much after that. I get fragments every now and again, pieces of dream that won’t stay in my memory. I see a young man in a white shirt and a straw hat and we start talking. After that I wake up for five seconds, as though I just broke out of a curse, and then I go back into unconsciousness.<br /><br />------------------------<br />“The practice of expelling magical energies in an offensive capacity is central to any good mage’s arsenal but it is in the last sub-discipline that the stigma arises. Rituals are not to be used carelessly. Even the most optimistic of these requires at least one tribute of Pure Light. The stronger the creature to be summoned, the more tributes of Light will be required. What constitutes a tribute of Light? I suspect the Ancient Magisters could tell us exactly but that was more than 2500 years ago and since the Northern Conclave has banned all research into this particular area, I fear that this question may not be answered for some time.”The Magical Practices, Second Edition<br />------------------------<br /><br />At that he put on his mask, opened his notebook and started chanting again. What was that language? Too sophisticated for Goblin, though they usually don’t venture further north than Peru (or so my textbooks say). Was it Elvish? No, it was something else, something older. It sounded almost heavenly. He produced a magic staff and marked four points around me. “Sugar, do you mind telling what you’re doing?” I was trying to be nice again.<br />Still no answer. Okay, let’s see. What’s older than Elvish? Well, the only thing that I would think of was, maybe, Valkyrian? It didn’t matter. I needed to get out before he finished the ritual. I didn’t have my staff so I couldn’t perform any spells which meant that I needed to figure something out and fast.<br /><br />------------------------ “Recent myth has it that the Valkyria, or Valkurer, were agents of God himself, presiding over His chosen people in their hour of need. Going back another 5000 years or so, the ancient myths say that they were gods in and of themselves. To this day, we know little of them but we do know that of all the magical species, they were, at one time, the strongest.”<br />Magical Beings and Where to Find Them, Fourth Edition<br />------------------------<br /><br />He finished with what I presume were his wards for keeping the demon he was summoning contained before moving over me and saying a few words. I started thrashing and moving again as he came closer, hoping to grab at him or something but my bonds were too tight. I was screaming by the time he said the final words and the beams of light came down from above. They ignited the four points that he had drawn, each shining brilliantly, before they were channeled into my direction. Oddly enough I didn’t feel a thing. I had stopped my screaming but even with the beams of pure light converging on my body, I still didn’t feel anything. I laid there for thirty seconds before the pillars of illumination turned a deep shade of red. They ended up disappearing after a few seconds, vanishing just as quickly as they had appeared in the first place. This was odd. I didn’t feel any different. I lifted my head and checked my body. Nope, not different.“Impossible! That should’ve worked!” The man in the mask said, speaking in a tongue I knew.<br />I heard him muttering something that sounded like ‘Lord Felgrand’ while he consulted his notebook.<br />“One pure maiden should be enough” he said, paging furiously.<br />“It happens.” I said relaxing. If that was his requirement, then this idiot wasn’t summoning anything. Not as long as I was his tribute.<br />“I think you may have the wrong girl. Would you mind untying me now?”'
				);
				
				include('src/views/post/index.html');
			

		}
	}