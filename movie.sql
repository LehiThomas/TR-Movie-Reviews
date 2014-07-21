-- ------------------------------------------------------------------
--  Filename:       movies.sql
--  Author:         Lehi Thomas
--  Created:        12-June-2014
--  Last Updated:   20-July-2014
--  Description:    This drops and creates the tables for the database
--                  associated with the www.trippyrodeo.com.
--                  It also seeds all of the tables.
-- ------------------------------------------------------------------

-- This enables dropping tables with foreign key dependencies.
-- It is specific to the InnoDB Engine.
SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------------
-- Table structures
-- ------------------------------------------------------------------
--
-- Table structure for MOVIE
--
DROP TABLE IF EXISTS movie;
CREATE TABLE movie
( movie_id      INT UNSIGNED    PRIMARY KEY AUTO_INCREMENT
, title         VARCHAR(200)    NOT NULL
, subtitle      VARCHAR(200)    
, rating        INT UNSIGNED    
, spec_rating   FLOAT(3,1)
, synopsis      TEXT            NOT NULL
, review        TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001;

--
-- Table Structure for INFO
--
DROP TABLE IF EXISTS info;
CREATE TABLE info
( info_id       INT UNSIGNED    PRIMARY KEY AUTO_INCREMENT
, movie_id      INT UNSIGNED    NOT NULL
, genre         VARCHAR(60)     NOT NULL
, director      VARCHAR(60)     NOT NULL
, produced_by   VARCHAR(200)    NOT NULL
, released_by   VARCHAR(200)    NOT NULL
, MPAA_rating   VARCHAR(6)      
, length        INT UNSIGNED    
, release_date  DATE            NOT NULL
, KEY movie_fk1 (movie_id)
, CONSTRAINT movie_fk1 FOREIGN KEY (movie_id) REFERENCES movie (movie_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001;;


--
-- Table Structure for IMAGES
--
DROP TABLE IF EXISTS images;
CREATE TABLE images
( image_id      INT UNSIGNED    PRIMARY KEY AUTO_INCREMENT
, movie_id      INT UNSIGNED    NOT NULL    
, url           VARCHAR(100)    NOT NULL
, alt           VARCHAR(100)    NOT NULL
, KEY images_fk1 (movie_id)
, CONSTRAINT images_fk1 FOREIGN KEY (movie_id) REFERENCES movie (movie_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001;;


--
-- Table Structure for TRAILER
--
DROP TABLE IF EXISTS trailer;
CREATE TABLE trailer
( trailer_id     INT UNSIGNED   PRIMARY KEY AUTO_INCREMENT
, movie_id       INT UNSIGNED    NOT NULL    
, code           VARCHAR(200)    NOT NULL
, KEY trailer_fk1 (movie_id)
, CONSTRAINT trailer_fk1 FOREIGN KEY (movie_id) REFERENCES movie (movie_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001;;


--
-- Table Structure for SUPPORT
--
DROP TABLE IF EXISTS support;
CREATE TABLE support
( support_id   INT UNSIGNED   PRIMARY KEY AUTO_INCREMENT
, title        VARCHAR(60)          NOT NULL
, html_code    TEXT                 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001;;


--
-- Table Structure for USER
--
DROP TABLE IF EXISTS user;
CREATE TABLE user
( user_id     INT UNSIGNED    PRIMARY KEY AUTO_INCREMENT
, email       VARCHAR(50)     NOT NULL 
, first_name  VARCHAR(20)     NOT NULL
, last_name   VARCHAR(40)     NOT NULL
, password    VARCHAR(150)    NOT NULL
, admin       ENUM('N', 'Y')  NOT NULL
, UNIQUE (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001;


--
-- Table Structure for COMMENTS
--
DROP TABLE IF EXISTS comments;
CREATE TABLE comments
( comment_id   INT UNSIGNED    PRIMARY KEY AUTO_INCREMENT
, movie_id     INT UNSIGNED    NOT NULL 
, username     VARCHAR(20)     NOT NULL
, title        VARCHAR(100)    NOT NULL
, comment      VARCHAR(500)    NOT NULL
, date         DATETIME        NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001;;

-- ------------------------------------------------------------------
-- Data inserts for the tables.
-- ------------------------------------------------------------------
--
-- Data for the MOVIE table
--
INSERT INTO movie  
(     title
	, subtitle
	, rating
	, spec_rating
	, synopsis
	, review)
VALUES 
 ('The Lengend of Hercules', NULL, 5, 5.7, '<p>The heroic son of Zeus embraces his incredible destiny by fighting to reclaim his kingdom from his villainous stepfather in this sweeping mythological adventure from director Renny Harlin. Born half-man/half-god and imbued with awe-inspiring superhuman strength, Hercules <a href="http://www.imdb.com/name/nm1553725/?ref_=nv_sr_1" title="Kellan Lutz IMDB profile">(Kellan Lutz)</a> falls into a forbidden romance that quickly incurs the wrath of his calculating stepfather, the King. Subsequently exiled and forced into slavery, the heroic Hercules fights for his life as a gladiator, and vows to free his people from the tyranny of the evil monarch.</p>', '<p>The Legend of Hercules suffered from a low budget and a poor script. I\'m starting to think that we are doomed to never have a decent Hercules movie. Well, with the exception of the one Disney did that is. Much of the story felt rushed. They had a good foundation set up but then they went and flew through the movie too quickly. They set up Hercules and his army for a big battle at the end were they are desperately outnumbered, but then have Hercules kill everyone with a gigantic lighting bolt whip. What a waste of what could have been an epic scene! The biggest problem with this movie is that it had too many parts that just did not make sense. (Spoiler Alert!) Like how Hercules\' love interest takes one through the chest, killing someone behind her, but ends up living? This movie was plagued with problems like this. It wasn\'t hard to tell that this movie didn\'t have the budget of others but it was the script more than anything that doomed it. The plot was rushed and therefore weak since they didn\'t take the time to fully develop it properly. The one thing I did like about this movie was the fight sequences. The hand-to-hand combat was well choreographed and fun to watch. Hercules has a long way to go from being a great movie, but it was still entertaining. We gave it a 5 out of 10.</p>')
,('Jack Ryan', 'Shadow Recruit', 7, 7.6, '<p>CIA analyst Jack Ryan <a href="http://www.imdb.com/name/nm1517976/?ref_=nv_sr_4" title="Chris Pine IMDB profile">(Chris Pine)</a> uncovers evidence of a Russian conspiracy to destroy the U.S. economy, and races to protect his fiance <a href="http://www.imdb.com/name/nm0461136/?ref_=nv_sr_1" title="Keira Knightley IMDB profile">(Keira Knightley)</a> while working with his seasoned mentor William Harper <a href="http://www.imdb.com/name/nm0000126/?ref_=nv_sr_1" title="Kevin Costner IMDB profile">(Kevin Costner)</a> to prevent a disaster of catastrophic proportions. Meanwhile, the malevolent Russian businessman <a href="http://www.imdb.com/name/nm0000110/?ref_=nv_sr_1" title="Kenneth Branagh IMDB profile">(Kenneth Branagh)</a> behind the terroristic plot awaits the perfect moment to set it into motion.</p>', NULL)
,('Ride Along', NULL, 6, 6.4, '<p>Ben <a href="http://www.imdb.com/name/nm0366389/?ref_=nv_sr_3" title="Kevin Hart IMDB profile">(Kevin Hart)</a> longs to marry his gorgeous girlfriend Angela, but before he can propose he must first get the approval of her tough-as-nails brother James <a href="http://www.imdb.com/name/nm0001084/?ref_=nv_sr_1" title="Ice Cube IMDB profile">(Ice Cube)</a>, a top detective in the Atlanta Police Department. When aspiring police officer Ben gets accepted into the academy, he finally musters the courage to ask for James\' blessings. Still unconvinced that Ben has what it takes to provide for his beloved baby sister, James invites Ben on a ride-along through the toughest parts of town. At first James\' efforts to terrify the young trainee go perfectly according to plan, but once the pair incur the wrath of Atlanta\'s most feared criminal, all bets are off.</p>', NULL)
,('I, Frankenstein', NULL, NULL, NULL, '<p>Two centuries after Dr. Frankenstein assembles and reanimates his creature, Adam <a href="http://www.imdb.com/name/nm0001173/?ref_=nv_sr_3" title="Aaron Eckhart IMDB profile">(Aaron Eckhart)</a> is still living. He becomes embroiled in a war between two immortal races: gargoyles, the traditional protectors of mankind, and evil demons. Since Adam is neither human nor demon, gargoyle Queen Leonore <a href="http://www.imdb.com/name/nm0001584/?ref_=nv_sr_2" title="Miranda Otto IMDB profile">(Miranda Otto)</a> and demon Prince Naberius <a href="http://www.imdb.com/name/nm0631490/?ref_=nv_sr_1" title="Bill Nighy IMDB profile">(Bill Nighy)</a> each want him for their own purposes. It is up to Adam to discover his inner humanity and the reason for his continued existence.</p>', NULL)
,('The Monuments Men', NULL, 8, 8.1, '<p>Cowriter and director <a href="http://www.imdb.com/name/nm0000123/?ref_=nv_sr_1" title="George Clooney IMDB profile">George Clooney</a> adapts author Robert M. Edsel\'s book The Monuments Men: Allied Heroes, Nazi Thieves, and the Greatest Treasure Hunt in History to tell the incredible true story of the seven art historians and museum curators who went behind enemy lines during World War II on a mission to recover some of the world\'s greatest works of art. With war raging in Europe, the Nazis have managed to plunder some of the biggest art collections on the continent. As the Third Reich begins to topple, the German army receives explicit orders that in the event of Adolf Hitler\'s death, they are to destroy every work of art in their possession. Determined to prevent 1000 years of culture from going up in flames, Frank Stokes (Clooney) leads a task force comprised entirely of art experts to enter Germany, recover the works of art, and ensure they are returned to their rightful owners. <a href="http://www.imdb.com/name/nm0000949/?ref_=nv_sr_1" title="Cate Blanchett IMDB profile">Cate Blanchett</a>, <a href="http://www.imdb.com/name/nm0000354/?ref_=nv_sr_3" title="Matt Damon IMDB profile">Matt Damon</a>, <a href="http://www.imdb.com/name/nm0000195/?ref_=nv_sr_1" title="Bill Murray IMDB profile">Bill Murray</a>, <a href="http://www.imdb.com/name/nm0000422/?ref_=nv_sr_1" title="John Goodman IMDB profile">John Goodman</a>, and <a href="http://www.imdb.com/name/nm0241121/?ref_=nv_sr_1" title="Jean Dujardin IMDB profile">Jean Dujardin</a> also star.</p>' ,NULL)
,('The LEGO Movie', NULL, 8, 8.2, '<p>A lowly Lego figure (voiced by <a href="http://www.imdb.com/name/nm0695435/?ref_=nv_sr_1" title="Chris Pratt IMDB profile">Chris Pratt</a>) joins a group of master LEGO builders intent on battling the evil Lord Business (voiced by <a href="http://www.imdb.com/name/nm0002071/?ref_=nv_sr_2" title="Will Ferrell IMDB profile">Will Ferrell</a>) after a case of mistaken identity puts him right in the middle of the battle between good and evil in this computer-generated comedy from the filmmakers behind Cloudy With a Chance of Meatballs and co-director Chris McKay (Robot Chicken). <a href="http://www.imdb.com/name/nm0004715/?ref_=nv_sr_4" title="Will Arnett IMDB profile">Will Arnett</a> co-stars as the voice of Batman, who along with Superman, make appearances in the Warner Bros. picture. <a href="http://www.imdb.com/name/nm0006969/?ref_=nv_sr_2" title="Elizabeth Banks IMDB profile">Elizabeth Banks</a>, <a href="http://www.imdb.com/name/nm0000151/?ref_=nv_sr_2" title="Morgan Freeman IMDB profile">Morgan Freeman</a>, <a href="http://www.imdb.com/name/nm0000553/?ref_=nv_sr_1" title="Liam Neeson IMDB profile">Liam Neeson</a>, and <a href="http://www.imdb.com/name/nm1555340/?ref_=nv_sr_1" title="Alison Brie IMDB profile">Alison Brie</a> head up the rest of the voice cast.</p>', NULL)
,('Robocop', NULL, 7, 7.7, '<p>The year is 2028. For a long time, cutting-edge robotics company OmniCorp has been supplying the U.S. military with drones for use overseas, though their repeated attempts to bring the technology stateside has met with fierce resistance. When devoted family man and upstanding Detroit policeman Alex Murphy <a href="http://www.imdb.com/name/nm1172478/?ref_=nv_sr_1" title="Joel Kinnaman IMDB profile">(Joel Kinnaman)</a> is grievously wounded in the line of duty, OmniCorp CEO Raymond Sellars <a href="http://www.imdb.com/name/nm0000474/?ref_=nv_sr_1" title="Michael Keaton IMDB profile">(Michael Keaton)</a> attempts to innovate by recruiting top scientist Dennett Norton <a href="http://www.imdb.com/name/nm0000198/?ref_=nv_sr_1" title="Gary Oldman IMDB profile">(Gary Oldman)</a> to transform Murphy into a prototype half-man/half-robot crime-fighter. When initial tests fail to provide the results OmniCorp had hoped for, Norton reprograms Robocop to operate strictly on software rather than human emotion. But as Murphy\'s emotions begin to interfere with his programming, he sets out to find the criminals who nearly killed him, and ensure that justice is served.</p>', NULL)
,('3 Days to Kill', NULL, NULL, NULL, '<p>A terminally ill Secret Service agent is coaxed out of retirement for one last job in exchange for an experimental drug that could save his life, and give him more time with his estranged family. For decades Ethan Runner <a href="http://www.imdb.com/name/nm0000126/?ref_=nv_sr_1" title="Kevin Costner IMDB profile">(Kevin Costner)</a> has kept his dangerous career a carefully guarded secret; not even his wife and daughter know what he really does for a living. Shortly after receiving a grim medical diagnosis, Ethan decides to give up his dangerous career for one last shot at being a decent husband and father. Meanwhile, Ethan has been tasked with watching his daughter while his wife goes out of town for a few days. But when the agency offers Ethan a life-saving cure in exchange for capturing a notorious terrorist, he reluctantly accepts. Now, with his daughter\'s safety in his hands for the first time in a decade and the powerful drug\'s debilitating side effects taking hold, the hunt begins.</p>', NULL)
,('Non-Stop', NULL, 7, 7.1, '<p>Bill Marks <a href="http://www.imdb.com/name/nm0000553/?ref_=nv_sr_2" title="Liam Neeson IMDB profile">(Liam Neeson)</a>, a former cop dealing with his daughter\'s death by drinking, is now a federal air marshal. While on a flight from New York to London, Marks gets a text telling him that unless 150 million dollars is transferred to an offshore account, someone will die every 20 minutes. But the harder Marks works to identify a suspect, the deeper he implicates himself in what becomes a deadly hostage crisis unfolding at 30,000 feet over the Atlantic Ocean. Marks must race the clock to save his name and protect his passengers.</p>', '<p>Non-Stop is a suspenseful thriller that is as cliche as it gets. Don\'t get me wrong, it was not a bad movie, the reason cliche things exist is because they work, and for Non-Stop they work again, you just won\'t see anything that you haven\'t already seen before. The filmmaking was well done and many of the twists and thrills played perfectly into the story. After the initial setup, it doesn\'t take long to get right into the story and the mystery. Eventually you run into some decisions made by Marks that are questionable at best and you have to wonder if this is the result of poor script or the character\'s state of mind. I like to give them the benefit of the doubt when watching a movie but it does make you wonder. However, the movie does do a good job playing on the audience\'s fears (everyone has hijacking fears and plummeting out of the sky right?!) to keep you watching. My biggest complaint with the movie was the "big reveal" of the terrorists at the end didn\'t feel like much of a big reveal at all. It felt hollow, like the script writers were scraping the bottom of the barrow for something new that hasn\'t been done before. Putting that aside, Non-Stop was entertaining in all the right ways and had an excellent cast to make up for were the plot lacked. Not only in Liam Neeson but also <a href=http://www.imdb.com/name/nm0000194/?ref_=nv_sr_4 title="Julianne Moore IMDB profile">Julianne Moore</a> as Jen Summers, a friendly passenger on the plane, and <a href=http://www.imdb.com/name/nm1890784/?ref_=nv_sr_1 title="Michelle Dockery IMDB profile">Michelle Dockery</a> as Nancy, the helpful flight attendant. They work well together and keep the story moving at an acceptable pace, maybe a bit slow at times, but still fast enough to keep you interested. For this, we give Non-Stop a 7 out of 10.</p>')
,('Mr. Peabody & Sherman', NULL, NULL, NULL, '<p>Mr. Peabody (voiced by <a href="http://www.imdb.com/name/nm0123092/?ref_=nv_sr_1" title="Ty Burrell IMDB profile">Ty Burrell</a>) is a business titan, inventor, scientist, gourmand, two-time Olympic medalist and genius...who also happens to be a dog. Using his most ingenious invention, the WABAC machine, Mr. Peabody and his adopted boy Sherman (voiced by <a href="http://www.imdb.com/name/nm1934618/?ref_=nv_sr_2" title="Max Charles IMDB profile">Max Charles</a>) hurtle back in time to experience world-changing events first-hand and interact with some of the greatest characters of all time. But when Sherman breaks the rules of time travel, our two heroes find themselves in a race to repair history and save the future, while Mr. Peabody may face his biggest challenge yet - being a parent.</p>', NULL)
,('Need for Speed', NULL, NULL, NULL, '<p>Inspired by the popular video-game franchise of the same name, Need for Speed tells the story of garage owner Tobey Marshall <a href="http://www.imdb.com/name/nm0666739/?ref_=nv_sr_2" title="Aaron Paul IMDB profile">(Aaron Paul)</a>. Desperate to keep his family-owned business afloat, Marshall forms an uncomfortable partnership with wealthy ex-NASCAR star Dino Brewster <a href="http://www.imdb.com/name/nm1002641/?ref_=nv_sr_2" title="Dominic Cooper IMDB profile">(Dominic Cooper)</a>. That partnership falls apart when a lucrative sale to car broker Julia Bonet <a href="http://www.imdb.com/name/nm1782299/?ref_=nv_sr_1" title="Imogen Poots IMDB profile">(Imogen Poots)</a> fails to pan out, and unscrupulous Brewster uses a tragic street-racing mishap to have the innocent Marshall incarcerated. Released from prison two years later, the vengeful Marshall plots to prove his mettle by winning the De Leon, an illicit race showcasing the country\'s top underground talents. But getting to the De Leon will be no simple task, because not only has the ruthless Brewster put a bounty on Marshall\'s prized car, but the police are hot on his trail during the white-knuckle, coast-to-coast dash. Fortunately for Marshall, his loyal crew and Bonet are willing to help him get to the starting line in time for the big race.</p>', NULL)
,('Divergent', NULL, NULL, NULL, '<p>In a world where the population is divided into factions by personality types, Tris Prior <a href="http://www.imdb.com/name/nm0940362/?ref_=nv_sr_1" title="Shailene Woodley IMDB profile">(Shailene Woodley)</a> is classified as Divergent. When she uncovers a conspiracy to eliminate all Divergents, she teams with the mysterious Four <a href="http://www.imdb.com/name/nm3772243/?ref_=nv_sr_1" title="Theo James IMDB profile">(Theo James)</a> to find out what makes the powers-that-be so frightened of them.</p>', NULL)
,('Captain America', 'The Winter Soldier', 9, 9.2, '<p>For Steve Rogers, awakening after decades of suspended animation involves more than catching up on pop culture; it also means that this old school idealist must face a world of subtler threats and difficult moral complexities. That comes clear when Director Nick Fury is killed by the mysterious assassin, the Winter Soldier, but not before warning Rogers that SHIELD has been subverted by its enemies. When Rogers acts on Fury\'s warning to trust no one, he is branded as a traitor by the organization. Now a fugitive, Captain America must get to the bottom of this deadly mystery with the help of the Black Widow and his new friend, The Falcon. However, the battle will be costly for the Sentinel of Liberty, with Rogers finding enemies where he least expects them while learning that the Winter Soldier looks disturbingly familiar. </p>', NULL)
,('Island of Lemurs', 'Madagascar', NULL, NULL, '<p>Academy Award winner <a href="http://www.imdb.com/name/nm0000151/?ref_=nv_sr_2" title="Morgan Freeman IMDB profile">Morgan Freeman</a> narrates this documentary that takes viewers to scenic Madagascar, where scientist Patricia Wright works diligently to help the diverse yet endangered lemur species learn the skills needed to survive in our constantly changing world. Mark Mothersbaugh provides the score for this IMAX 3D film featuring music by Hanitrarivo Rasoanaivo and Tarika.</p>', NULL)
,('Draft Day', NULL, NULL, NULL, '<p><a href="http://www.imdb.com/name/nm0000126/?ref_=nv_sr_1" title="Kevin Costner IMDB profile">Kevin Costner</a> stars as Sonny Weaver Jr., the GM of the Cleveland Browns. With 13 hours until the beginning of the NFL draft, Sonny is informed by the team\'s owner <a href="http://www.imdb.com/name/nm0001449/?ref_=nv_sr_1" title="Frank Langella IMDB profile">(Frank Langella)</a> that if Sonny doesn\'t make a splash and generate ticket sales, he\'s going to be fired. That prompts the GM to take a trade offer from another team that gives him the first pick in the draft, in exchange for three future first-round picks. The move outrages the Browns\' head coach, and forces all of the team\'s scouts to dig up what they can find about the pick everyone, including the owner, expects them to make -- a highly touted QB from Wisconsin. Meanwhile, Weaver is drawn to a talented linebacker who has family issues to deal with and is known for having a hot temper.</p>', NULL)
,('Transcendence', NULL, NULL, NULL, '<p>His entire career, Dr. Will Caster <a href="http://www.imdb.com/name/nm0000136/?ref_=nv_sr_1" title="Johnny Depp IMDB profile">(Johnny Depp)</a> has been working toward one goal -- to create a machine possessing the entire spectrum of human emotions, and the collective intelligence of every person who has ever lived. But while Dr. Caster\'s unorthodox experiments have made him famous in scientific circles, a radical anti-tech group known as Rift is determined to stop him at all costs. In the midst of an attack on A.I. labs across the United States, one Rift agent manages to shoot Dr. Caster with a radioactive bullet, ensuring his death. Little did Rift realize that their efforts to destroy Dr. Caster would only make him stronger than they ever could have imagined, because before he dies, his wife Evelyn <a href="http://www.imdb.com/name/nm0356017/?ref_=nv_sr_2" title="Rebecca Hall">(Rebecca Hall)</a> and best friend Max <a href="http://www.imdb.com/name/nm0079273/?ref_=nv_sr_6" title="Paul Bettany IMDB profile">(Paul Bettany)</a> successfully transfer Dr. Caster\'s consciousness into a computer, where his hunger for knowledge and power transforms him into an unstoppable force of sentient energy inhabiting every computer and electrical system on the planet.</p>', NULL)
,('Brick Mansions', NULL, NULL, NULL, '<p>Detroit has fallen to crime, and in an effort to contain it, authorities have sealed up the inner city with a massive wall. Once you\'re inside, you never get out. Lino <a href="http://www.imdb.com/name/nm1042642/?ref_=nv_sr_1" title="David Belle IMDB profile">(David Belle)</a> is an ex-con who\'s trying to make the best of life in this urban penitentiary when his girlfriend is abducted by ruthless drug lord Tremaine. Meanwhile, as undercover cop Damien Collier <a href="http://www.imdb.com/name/nm0908094/?ref_=nv_sr_1" title="Paul Walker IMDB profile">(Paul Walker)</a> contends with deep-rooted corruption within the police department, Tremaine imprisons the mayor, and threatens to detonate a powerful weapon unless he\'s paid millions in ransom. Despite their differences, Lino and Collier are the only men capable of entering the city, and defeating Tremaine\'s gang. With the clock ticking, this mismatched duo must now prevent Detroit from being completely decimated by a maniac who holds the entire city in the palm of his hand.</p> ', NULL)
,('X-Men', 'Days of Future Past', 10, 10.5, '<p>In order to prevent a grim future in which mutants and their human sympathizers are systematically hunted and killed by towering, unstoppable robots called Sentinels, Wolverine <a href="http://www.imdb.com/name/nm0413168/?ref_=nv_sr_1" title="Hugh Jackman">(Hugh Jackman)</a> travels back in time to change the course of history. But first he must convince a young Professor Xavier and Magneto to join forces for the good for humanity.</p>', NULL)
,('Godzilla', NULL, 7, 7.7, '<p>In 1999, the Janjira nuclear plant was mysteriously destroyed with most hands lost including supervisor Joe Brody\'s <a href="http://www.imdb.com/name/nm0186505/?ref_=tt_cl_t4" title="Bryan Cranston IMDB profile">(Bryan Cranston)</a> colleague and wife, Sandra. Years later, Joe\'s son, Ford <a href="http://www.imdb.com/name/nm1093951/?ref_=tt_cl_t1" title="Aaron Taylor-Johnson IMDB profile">(Aaron Taylor-Johnson)</a>, a US Navy ordnance disposal officer, must go to Japan to help his estranged father who obsessively searches for the truth of the incident. In doing so, father and son discover the disaster\'s secret cause on the wreck\'s very grounds. This enables them to witness the reawakening of a terrible threat to all of Humanity, which is made all the worse with a second secret revival elsewhere. Against this cataclysm, the only hope for the world may be Godzilla, but the challenge for the King of the Monsters will be great even as Humanity struggles to understand the destructive ally they have.</p>', '<p>"Godzilla" was almost everything you would expect from a monster movie. Almost. The CGI was very well done, which had my 10 year old self giddy during the monster fight scenes. The problem was that there didn\'t seem to be as much monster as I would have liked. There was definitely too much human scene time. The audience was on the edge of their seats waiting to see the big beastie, and they had to sit there a while before seeing him in action, or seeing him at all for that matter. Also, one of my biggest movie pet-peeves is when they heavily use a star to advertise the movie, and then get rid of the character early. It happened with Channing Tatum in "G.I. Joe 3," it happened with Samuel L. Jackson in "Deep BLue Sea" and they did it again with Bryan Cranston. Cranston did a good job for the little of the film he was in, but no performances really stood out. It does seem that this film served the purpose of laying down some framework that they can use in the sequel, but we will have to wait and see how that plays out. Overall, "Godzilla" was suspenseful and entertaining. The monster fights, when they did happen, were fun to watch and well done visually. I hope they take the effort to improve the sequel. We gave the King of monster a 7 out of 10.</p>')
,('The Amazing Spider-Man 2', NULL, 8, 8.5, '<p>For Peter Parker <a href="http://www.imdb.com/name/nm1940449/?ref_=tt_cl_t1" title="Andrew Garfield IMDB profile">(Andrew Garfield)</a>, life is busy - between taking out the bad guys as Spider-Man and spending time with the person he loves, Gwen Stacey <a href="http://www.imdb.com/name/nm1297015/?ref_=tt_cl_t2" title="Emma Stone IMDB profile">(Emma Stone)</a>, high school graduation can\'t come quickly enough. Peter hasn\'t forgotten about the promise he made to Gwen\'s father to protect her by staying away - but that\'s a promise he just can\'t keep. Things will change for Peter when a new villain, Electro <a href="http://www.imdb.com/name/nm0004937/?ref_=tt_cl_t3" title="Jamie Foxx IMDB profile">(Jamie Foxx)</a>, emerges, an old friend, Harry Osborn <a href="http://www.imdb.com/name/nm2851530/?ref_=tt_cl_t4" title="Dane DeHaan IMDB profile">(Dane DeHaan)</a>, returns, and Peter uncovers new clues about his past</p>', NULL)
,('Edge of Tomorrow', NULL, NULL, NULL, '<p>An alien race has hit the Earth in an unrelenting assault, unbeatable by any military unit in the world. Major William Cage <a href="http://www.imdb.com/name/nm0000129/?ref_=tt_cl_t1" title="Tom Cruise IMDB profile">(Tom Cruise)</a> is an officer who has never seen a day of combat when he is unceremoniously dropped into what amounts to a suicide mission. Killed within minutes, Cage now finds himself inexplicably thrown into a time loop-forcing him to live out the same brutal combat over and over, fighting and dying again and again. But with each battle, Cage becomes able to engage the adversaries with increasing skill, alongside Special Forces warrior Rita Vrataski <a href="http://www.imdb.com/name/nm1289434/?ref_=tt_cl_t2" title="Emily Blunt IMDB profile">(Emily Blunt)</a>. And, as Cage and Vrataski take the fight to the aliens, each repeated encounter gets them one step closer to defeating the enemy.</p>', NULL)
,('How to Train Your Dragon 2', NULL, NULL, NULL, '<p>Dragons and Vikings have finally made peace, but when the villainous Drago plots a massive invasion, it\'s up to Hiccup (voice of <a href="http://www.imdb.com/name/nm0059431/?ref_=nv_sr_1" title="Jay Baruchel IMDB profile">Jay Baruchel</a>) and Toothless to save the day in this sequel from DreamWorks Animation.</p>', NULL)
,('Transformers', 'Age of Extinction', 8, 7.9, '<p>As humanity picks up the pieces, following the conclusion of "Transformers: Dark of the Moon," Autobots and Decepticons have all but vanished from the face of the planet. However, a group of powerful, ingenious businessman and scientists attempt to learn from past Transformer incursions and push the boundaries of technology beyond what they can control - all while an ancient, powerful Transformer menace sets Earth in his crosshairs. The epic adventure and battle between good and evil, freedom and enslavement ensues.</p>', '<p>I was worried going in to see Transformers. Any reviews I could find were not kind to the reboot non-reboot movie. Maybe it is because I had lower expectations going in, but I was pleased with the movie. Both my wife and I enjoyed it, despite some problems with the movie overall. What I noticed is that this movie is much of the same as the previous Transformers movies. If you liked the other movies then chances are you will like this one as well. However, if you weren\'t a fan of the other movies then don\'t get your hopes up. Visually, this movie was fantastic. The Dinobots were incredible but under utilized. The fight sequences were marvelous and what you come to expect with these movies. The plot however was lacking. It seemed like they tried to fit too much into one movie and the result was one really long movie that didn\'t always make much sense. <a href="http://www.imdb.com/name/nm0000242/?ref_=tt_cl_t1" title="Mark Wahlberg IMDB profile">Mark Wahlberg</a> was an excellent addition to the cast and made a much more believable action hero than Shia LaBeouf. <a href="http://www.imdb.com/name/nm0001804/?ref_=tt_cl_t2" title="Stanley Tucci IMDB profile">Stanley Tucci</a> and <a href="http://www.imdb.com/name/nm0001288/?ref_=ttfc_fc_cl_t3" title="Kelsey Grammer IMDB profile">Kelsey Grammer</a> also were outstanding in their roles. This new and improved human cast helped move the movie along but couldn\'t completely make up for the weak plot. We gave this movie an 8 out of 10 for fantastic visual effects and acting.</p>')
,('Dawn of the Planet of the Apes', NULL, 9, 9.1, '<p>This follow-up to "Rise of the Planet of the Apes" concerns the next step in the genetically advanced primates\' takeover of the world as a virus begins to wipe out the human race.</p>', '<p>"Dawn of the Planet of the Apes" is the 8th installment in the "Planet of the Apes" franchise and there is no doubt that it does the the series justice. The movie picks up 10 years after the previous film, "Rise of the Planet of the Apes", with Caesar as the leader of the apes. <a href="http://www.imdb.com/name/nm0785227/?ref_=nv_sr_1" title="Andy Serkis IMDB profile">Andy Serkis</a> does the voice and motion capture of Caesar and gives a phenominal performance. This movie was all about the apes. Sure, <a href="http://www.imdb.com/name/nm0164809/?ref_=nv_sr_2" title="Jason Clarke IMDB profile">Jason Clarke</a> does a good job as Malcolm, an ape-sympathetic human, but most of the human roles were generic and unmemorable. The cast did well in their performances but nothing to stand out. There was no doubt that this movie belonged to the apes. This movie felt more like a warning to humanity than just another "Planet of the Apes" sequel. Some people have gone as far as to compare it to the Israel-Palestine conflict and other similar situations. The story plays out beautifully and tragically like an old Shakespearean play. Much of the movie you don\'t know if you are rooting for the humans or the apes. The CGI was incredible. You could probably show parts of this movie to your gullible friends and have them believing that there are actually apes living in the woods just outside of San Francisco. Throughout the whole movie I had a hard time beleiving that there was actually people underneath the CGI. THe plot was full and the acting spot on. While "Dawn" didn\'t have the big name or publicity surrounding it that other summer blockbusters have had, it still manages to out perform most of its competitors. We gave this movie a 9 out of 10 and are eagerly awaiting the next one.</p>')
,('Hercules', NULL, NULL, NULL, '<p>Fourteen hundred years ago, a tormented soul walked the earth that was neither man nor god. Hercules <a href="http://www.imdb.com/name/nm0425005/?ref_=tt_cl_t1" title="Dwayne Johnson IMDB profile">(Dwayne "The Rock" Johnson)</a> was the powerful son of the god king Zeus, for this he received nothing but suffering his entire life. After twelve arduous labours and the loss of his family, this dark, world-weary soul turned his back on the gods finding his only solace in bloody battle. Over the years he warmed to the company of six similar souls, their only bond being their love of fighting and presence of death. These men and women never question where they go to fight or why or whom, just how much they will be paid. Now the King of Thrace has hired these mercenaries to train his men to become the greatest army of all time. It is time for this bunch of lost souls to finally have their eyes opened to how far they have fallen when they must train an army to become as ruthless and blood thirsty as their reputation has become.</p>', NULL)
,('Guardians of the Galaxy', NULL, NULL, NULL, '<p>After stealing a mysterious orb in the far reaches of outer space, Peter Quill <a href="http://www.imdb.com/name/nm0695435/?ref_=tt_cl_t2" title="Chris Pratt IMDB profile">(Chris Pratt)</a>, a half human/half alien is now the main target of a manhunt lead by the villain known as Ronan the Accuser. To help fight Ronan and his team and save the galaxy from his power, Quill creates a team known as the \'Guardians of the Galaxy\' to save the world. </p>', NULL)
,('Teenage Mutant Ninja Turtles', NULL, NULL, NULL, '<p>Darkness has settled over New York City as Shredder and his evil Foot Clan have an iron grip on everything from the police to the politicians. The future is grim until four unlikely outcast brothers rise from the sewers and discover their destiny as Teenage Mutant Ninja Turtles. The Turtles must work with fearless reporter April O\'Neil and her cameraman Vernon Fenwick to save the city and unravel Shredder\'s diabolical plan.</p>', NULL)
,('The Giver', NULL, NULL, NULL, '<p>In a seemingly perfect community, without war, pain, suffering, differences or choice, a young boy is chosen to learn from an elderly man about the true pain and pleasure of the "real" world.</p>', NULL)
,('The Maze Runner', NULL, NULL, NULL, '<p>Based on the bestselling novel by James Dashner, this adventure thriller for young adults follows a young boy named Thomas who finds himself trapped within a giant, deadly maze with a group of other kids. While he has no memories of his life prior to the maze, he is plagued by nightmares about a shadowy organization known only as W.C.K.D., and hopes that these fragments of memories will help him discover the secrets of his past and a way to escape.</p>', NULL)
,('When the Game Stands Tall', NULL, NULL, NULL, '<p>The journey of legendary football coach Bob Ladouceur <a href="http://www.imdb.com/name/nm0001029/?ref_=nv_sr_3" title="Jim Caviezel IMDB profile">(Jim Caviezel)</a>, who took the De La Salle High School Spartans from obscurity to a 151-game winning streak that shattered all records for any American sport.</p>', NULL)
,('The Judge', NULL, NULL, NULL, '<p>Big city lawyer Hank Palmer <a href="http://www.imdb.com/name/nm0000375/?ref_=tt_cl_t1" title="Robert DOwney Jr IMDB profile">(Robert Downey Jr.)</a> returns to his childhood home where his father <a href="http://www.imdb.com/name/nm0000380/?ref_=tt_cl_t7" title="Robert Duvall IMDB profile">(Robert Duvall)</a>, the town\'s judge, is suspected of murder. Hank sets out to discover the truth and, along the way, reconnects with his estranged family.</p>', NULL)
,('Alexander', 'and the Terrible, Horrible,<br/> No Good, Very Bad Day', NULL, NULL, '<p>Alexander wakes up with gum in his hair, and things just get worse as his day progresses.</p>', NULL)
,('The Hunger Games', 'Mockingjay Part 1', NULL, NULL, '<p>Katniss Everdeen <a href="http://www.imdb.com/name/nm2225369/?ref_=tt_cl_t1" title="Jennifer Lawrence IMDB profile">(Jennifer Lawrence)</a> reluctantly becomes the symbol of a mass rebellion against the autocratic Capitol.</p>', NULL)
,('Dumb and Dumber To', NULL, NULL, NULL, '<p>20 years after the dimwits set out on their first adventure, they head out in search of one of their long lost children in the hope of gaining a new kidney.</p>', NULL)
,('The Hobbit', 'Battle of the Five Armies', NULL, NULL, '<p>The Company of Thorin has reached Smaug\'s lair; but, can Bilbo and the Dwarves reclaim Erebor and the treasure? And, if so, can they hold on to it?</p>', NULL)
,('Night at the Museum', 'Secret of the Tomb', NULL, NULL, '<p>Sorry, detail still not released. :( Please check back soon.</p>', NULL);


--
-- Data for the INFO table
-- 
INSERT INTO info
	( movie_id
	, genre
	, director
	, produced_by
	, released_by
	, MPAA_rating
	, length
	, release_date)
VALUES
 (1001, '<dd>Action</dd> <dd>Adventure</dd>', '<dd>Renny Harlin</dd>', '<dd>Nu Boyana</dd> <dd>Summit Entertainment</dd>', '<dd>Millennium Films</dd>', 'PG-13', 98, '2014-01-10')
,(1002, '<dd>Action</dd> <dd>Political Thriller</dd> <dd>Spy</dd>', '<dd>Kenneth Branagh</dd>', '<dd>Di Bonaventura Pictures</dd> <dd>Skydance Productions</dd>', '<dd>Paramount Pictures</dd>','PG-13', 105, '2014-01-17')
,(1003, '<dd>Action</dd> <dd>Comedy</dd>', '<dd>Tim Story</dd>', '<dd>Cube Vision</dd> <dd>LBI Entertainment</dd> <dd>Rainforest Films</dd> <dd>Universal Pictures</dd>', '<dd>Universal Pictures</dd>', 'PG-13', 99, '2014-01-17')
,(1004, '<dd>Science Fiction</dd>', '<dd>Stuart Beattie</dd>', '<dd>Hopscotch Features</dd> <dd>Lakeshore Entertainment</dd> <dd>Lionsgate</dd> <dd>Sidney Kimmel Entertainment</dd>', '<dd>Lionsgate</dd>', 'PG-13', 92, '2014-01-24')
,(1005, '<dd>War</dd> <dd>Drama</dd>', '<dd>George Clooney</dd>', '<dd>Fox 2000 Pictures</dd> <dd>Smokehouse Pictures</dd> <dd>Sony Pictures Entertainment</dd>', '<dd>20th Century Fox</dd> <dd>Columbia Pictures</dd>', 'PG-13', 118, '2014-02-7')
,(1006, '<dd>Children</dd> <dd>Comedy</dd>', '<dd>Phil Lord</dd> <dd>Christopher Miller</dd>', '<dd>Animal Logic</dd> <dd>Lin Pictures</dd> <dd>Vertigo Entertainment</dd> <dd>Village Roadshow</dd>', '<dd>LEGO Systems A/S</dd> <dd>Warner Bros</dd>', 'PG', 101, '2014-02-7')
,(1007, '<dd>Science Fiction</dd> <dd>Action</dd>', '<dd>Jose Padilha</dd>', '<dd>MGM</dd>', '<dd>Sony Pictures</dd>', 'PG-13', 117, '2014-02-12')
,(1008, '<dd>Thriller</dd> <dd>Action</dd>', '<dd>McG</dd>', '<dd>EuropaCorp</dd> <dd>Relativity Media', '<dd>Relativity Media</dd>', 'PG-13', 117, '2014-02-21')
,(1009, '<dd>Thriller</dd> <dd>Action</dd>', '<dd>Jaume Collet-Serra</dd>', '<dd>Dark Castle</dd> <dd>StudioCanal</dd>', '<dd>Universal Pictures</dd>', 'PG-13', 107, '2014-02-28')
,(1010, '<dd>Children</dd> <dd>Comedy</dd> <dd>Fantasy</dd>', '<dd>Rob Minkoff</dd>', '<dd>Bullwinkle Studios</dd> <dd>Classic Media</dd> <dd>DreamWorks Animation</dd>', '<dd>20th Century Fox</dd>', 'PG', 92, '2014-03-7')
,(1011, '<dd>Action</dd> <dd>Cars</dd>', '<dd>Scott Waugh</dd>', '<dd>DreamWorks Pictures</dd>', '<dd>Walt Disney Pictures</dd>', 'PG-13', 130, '2014-03-14')
,(1012, '<dd>Action</dd> <dd>Science Fiction</dd>', '<dd>Neil Burger</dd>', '<dd>Red Wagon Entertainment</dd>', '<dd>Summit Entertainment</dd>', 'PG-13', 140, '2014-03-21')
,(1013, '<dd>Action</dd> <dd>Superhero</dd> <dd>Spy</dd>', '<dd>Anthony Russo</dd> <dd>Joe Russo</dd>', '<dd>Marvel Entertainment</dd>', '<dd>Walt Disney Studios</dd>', 'PG-13', 136, '2014-04-04')
,(1014, '<dd>Nature</dd> <dd>Documentary</dd>', '<dd>David Douglas</dd> <dd>Drew Fellman</dd>', '<dd>IMAX</dd> <dd>Warner Bros Pictures</dd>', '<dd>IMAX</dd> <dd>Warner Bros Pictures</dd>', 'G', 40, '2014-04-04')
,(1015, '<dd>Drama</dd> <dd>Sports</dd>', '<dd>Ivan Reitman</dd>', '<dd>Montecito Picture Company</dd> <dd>OddLot Entertainment</dd>', '<dd>Summit Entertainment</dd>', 'PG-13', 110, '2014-04-11')
,(1016, '<dd>Science Fiction</dd> <dd>Adventure</dd>', '<dd>Wally Pfister</dd>', '<dd>Alcon Entertainment</dd> <dd>DMG Entertainment</dd>', '<dd>Straight Up Films</dd> <dd>Warner Bros</dd>', 'PG-13', 119, '2014-04-18')
,(1017, '<dd>Action</dd> <dd>Crime</dd> <dd>Thriller</dd>', '<dd>Camille Delamarre</dd>', '<dd>Brick Mansions Productions Inc</dd> <dd>Ciné+</dd> <dd>Relativity Media</dd>', '<dd>Big Bang Media</dd> <dd>CDI Films</dd> <dd>Relativity Media</dd>', 'PG-13', 90, '2014-04-25')
,(1018, '<dd>Action</dd> <dd>Fantasy</dd> <dd>Superhero</dd>', '<dd>Bryan Singer</dd>', '<dd>Marvel Entertainment</dd> <dd>Bad Hat Harry</dd> <dd>Donners\' Company</dd>', '<dd>20th Century Fox</dd> <dd>Dune Entertainment</dd>', 'PG-13', 131, '2014-05-23')
,(1019, '<dd>Science Fiction</dd> <dd>Action</dd>', '<dd>Gareth Edwards</dd>', '<dd>Legendary Pictures</dd>', '<dd>Legendary Pictures</dd> <dd>Warner Bros</dd>', 'PG-13', 123, '2014-05-16')
,(1020, '<dd>Action</dd> <dd>Superhero</dd> <dd>Science Fiction</dd>', '<dd>Marc Webb</dd>', '<dd>Columbia Pictures</dd> <dd>Marvel Studios</dd>', '<dd>Sony Pictures</dd>', 'PG-13', 142, '2014-05-02')
,(1021, '<dd>Science Fiction</dd> <dd>Action</dd>', '<dd>Doug Liman</dd>', '<dd>3 Arts Entertainment</dd>', '<dd>Warner Bros</dd>', 'PG-13', 113, '2014-06-06')
,(1022, '<dd>Children</dd> <dd>Fantasy</dd>', '<dd>Dean BeBlois</dd>', '<dd>DreamWorks Animation</dd>', '<dd>20th Century Fox</dd>', 'PG', 105, '2014-06-13')
,(1023, '<dd>Science Fiction</dd> <dd>Action</dd>', '<dd>Michael Bay</dd>', '<dd>DreamWorks</dd> <dd>Paramount Pictures</dd>', '<dd>Paramount Pictures</dd>', 'PG-13', 157, '2014-06-27')
,(1024, '<dd>Science Fiction</dd> <dd>Action</dd>', '<dd>Matt Reeves</dd>', '<dd>Chernin Entertainment</dd>', '<dd>20th Century Fox', 'PG-13', 130, '2014-07-11')
,(1025, '<dd>Mythology</dd> <dd>Fantasy</dd> <dd>Action</dd>', '<dd>Brett Ratner</dd>', '<dd>Film 44</dd> <dd>Paramount Pictures</dd>', '<dd>MGM</dd>', 'PG-13', NULL, '2014-07-25')
,(1026, '<dd>Science Fiction</dd> <dd>Action</dd>', '<dd>James Gunn</dd>', '<dd>Marvel Studios</dd>', '<dd>Walt Disney Pictures</dd>', 'PG-13', 122, '2014-08-01')
,(1027, '<dd>Science Fiction</dd> <dd>Superhero</dd> <dd>Action</dd>', '<dd>Jonathan Liebesman</dd>', '<dd>Nickelodeon Movies</dd> <dd>Platinum Dunes</dd>', '<dd>Paramount Pictures</dd>', 'PG-13', NULL, '2014-08-08')
,(1028, '<dd>Drama</dd>', '<dd>Phillip Noyce</dd>', '<dd>The Weinstein Company</dd> <dd>Walden Media</dd>', '<dd>20th Century Fox</dd>', NULL, NULL, '2014-08-15')
,(1029, '<dd>Action</dd> <dd>Adventure', '<dd>Wes Ball</dd>', '<dd>20th Century Fox</dd> <dd>Gotham Group', '<dd>20th Century Fox</dd>', NULL, NULL, '2014-09-19')
,(1030, '<dd>Drama</dd> <dd>Sports</dd>', '<dd>Thomas Carter</dd>', '<dd>Affirm Films</dd> <dd>Mandalay</dd>', '<dd>TriStar Pictures</dd>', 'PG', NULL, '2014-08-22')
,(1031, '<dd>Drama</dd> <dd>Thriller</dd>', '<dd>David Dobkin</dd>', '<dd>Big Kid Pictures</dd> <dd>Team Downey</dd> <dd>Warner Bros</dd>', '<dd>Warner Bros</dd>', 'PG-13', NULL, '2014-10-10')
,(1032, '<dd>Comedy</dd> <dd>Family</dd>', '<dd>Miguel Arteta</dd>', '<dd>Walt Disney Pictures</dd> <dd>21 Laps Entertainment</dd> <dd>Jim Henson Company</dd> <dd>Land of Plenty Productions</dd>', '<dd>Walt Disney Studios</dd>', 'PG', 81, '2014-10-10')
,(1033, '<dd>Action</dd> <dd>Science Fiction</dd>', '<dd>Francis Lawrence</dd>', '<dd>Color Force</dd> <dd>Lionsgate</dd>', '<dd>Lionsgate</dd>', 'PG-13', NULL, '2014-11-21')
,(1034, '<dd>Comedy</dd>', '<dd>Bobby Farrelly</dd> <dd>Peter Farrelly</dd>', '<dd>Red Granite</dd>', '<dd>Universal Pictures</dd>', 'PG-13', NULL, '2014-11-14')
,(1035, '<dd>Adventure</dd> <dd>Fantasy</dd>', '<dd>Peter Jackson</dd>', '<dd>MGM</dd> <dd>New Line Cinema</dd>', '<dd>Warner Bros</dd>', NULL, NULL, '2014-12-17')
,(1036, '<dd>Adventure</dd> <dd>Comedy</dd>', '<dd>Shawn Levy</dd>', '<dd>20th Century Fox</dd>', '<dd>20th Century Fox</dd>', NULL, NULL, '2014-12-19');



--
-- Data for the IMAGES table
-- 
INSERT INTO images 
	( movie_id
	, url
	, alt)
VALUES
 (1001, '/content/images/legendHercules.jpg', 'The Lengend of Hercules movie poster')
,(1002, '/content/images/JackRyan.jpg', 'Jack Ryan Shadow Recruit movie poster')
,(1003, '/content/images/rideAlong.jpg', 'Ride Along movie poster')
,(1004, '/content/images/Frankenstein.jpg', 'I, Frankenstein movie poster')
,(1005, '/content/images/monuments.jpg', 'The Monuments Men movie poster')
,(1006, '/content/images/lego.jpg', ' The LEGO Movie movie poster')
,(1007, '/content/images/robocop.jpg', 'Robocop movie poster')
,(1008, '/content/images/3days.jpg', '3 Days to Kill movie poster')
,(1009, '/content/images/non-stop.jpg', 'Non-Stop movie poster')
,(1010, '/content/images/peabody.jpg', 'Mr. Peabody & Sherman movie poster')
,(1011, '/content/images/speed.jpg', 'Need for Speed movie poster')
,(1012, '/content/images/divergent.jpg', 'Divergent movie poster')
,(1013, '/content/images/captain.jpg', 'Captain America The Winter Soldier movie poster')
,(1014, '/content/images/lemurs.jpg', 'Island of Lemurs Madagascar movie poster')
,(1015, '/content/images/draft.jpg', 'Draft Day movie poster')
,(1016, '/content/images/transcendence.jpg', 'Transcendence movie poster')
,(1017, '/content/images/brick.jpg', 'Brick Mansions movie poster')
,(1018, '/content/images/xmen.jpg', 'X-Men Days of Future Past movie poster')
,(1019, '/content/images/godzilla.jpg', 'Godzilla movie poster')
,(1020, '/content/images/spiderman.jpg', 'The Amazing Spider-Man 2 movie poster')
,(1021, '/content/images/tomorrow.jpg', 'Edge of Tomorrow movie poster')
,(1022, '/content/images/dragon.jpg', 'How to Train Your Dragon 2 movie poster')
,(1023, '/content/images/extinction.jpg', 'Transformers Age of Extinction movie poster')
,(1024, '/content/images/apes.jpg', 'Dawn of the Planet of the Apes movie poster')
,(1025, '/content/images/hercules.jpg', 'Hercules movie poster')
,(1026, '/content/images/guardians.jpg', 'Guardians of the Galaxy movie poster')
,(1027, '/content/images/turtles.jpg', 'Teenage Mutant Ninja Turtles movie poster')
,(1028, '/content/images/giver.jpg', 'The Giver movie poster')
,(1029, '/content/images/mazeRunner.jpg', 'The Maze Runner movie poster')
,(1030, '/content/images/gameStandsTall.jpg', 'When The Game Stands Tall Movie poster')
,(1031, '/content/images/judge.jpg', 'The Judge movie poster')
,(1032, '/content/images/alexander.jpg', 'Alexander and the Terrible, Horrible, No Good, Very Bad Day movie poster')
,(1033, '/content/images/mockingjay.jpg', 'The Hunger Games Mockingjay Part 2 movie poster')
,(1034, '/content/images/dumbAndDumber.jpg', 'Dumb and Dumber To movie poster')
,(1035, '', 'The Hobbit Battle of the Five Armies movie poster')
,(1036, '', 'Night at the Museum Secrets of the Tomb movie poster');



--
-- Data for the TRAILER table
-- 
INSERT INTO trailer 
	( movie_id
	, code)
VALUES
 (1001, '<iframe width="560" height="315" src="//www.youtube.com/embed/g0GMzQwO2l0" allowfullscreen></iframe>')
,(1002, '<iframe width="560" height="315" src="//www.youtube.com/embed/K9KAnx4EvaE" allowfullscreen></iframe>')
,(1003, '<iframe width="560" height="315" src="//www.youtube.com/embed/5klp6rkHIks" allowfullscreen></iframe>')
,(1004, '<iframe width="560" height="315" src="//www.youtube.com/embed/sCUZd1iuq3o" allowfullscreen></iframe>')
,(1005, '<iframe width="560" height="315" src="//www.youtube.com/embed/YTMqXnjtJS4" allowfullscreen></iframe>')
,(1006, '<iframe width="560" height="315" src="//www.youtube.com/embed/fZ_JOBCLF-I" allowfullscreen></iframe>')
,(1007, '<iframe width="560" height="315" src="//www.youtube.com/embed/INmtQXUXez8" allowfullscreen></iframe>')
,(1008, '<iframe width="560" height="315" src="//www.youtube.com/embed/gLBnKYDDDq8" allowfullscreen></iframe>')
,(1009, '<iframe width="560" height="315" src="//www.youtube.com/embed/jiHDJ19A3dk" allowfullscreen></iframe>')
,(1010, '<iframe width="560" height="315" src="//www.youtube.com/embed/aMl2tTVwsZA" allowfullscreen></iframe>')
,(1011, '<iframe width="560" height="315" src="//www.youtube.com/embed/e73J71RZRn8" allowfullscreen></iframe>')
,(1012, '<iframe width="560" height="315" src="//www.youtube.com/embed/sutgWjz10sM" allowfullscreen></iframe>')
,(1013, '<iframe width="560" height="315" src="//www.youtube.com/embed/7SlILk2WMTI" allowfullscreen></iframe>')
,(1014, '<iframe width="560" height="315" src="//www.youtube.com/embed/Q_7cVyM8Efg" allowfullscreen></iframe>')
,(1015, '<iframe width="560" height="315" src="//www.youtube.com/embed/K3SlVsdUuBY" allowfullscreen></iframe>')
,(1016, '<iframe width="560" height="315" src="//www.youtube.com/embed/VCTen3-B8GU" allowfullscreen></iframe>')
,(1017, '<iframe width="560" height="315" src="//www.youtube.com/embed/n-kIpUSByUM" allowfullscreen></iframe>')
,(1018, '<iframe width="560" height="315" src="//www.youtube.com/embed/gsjtg7m1MMM" allowfullscreen></iframe>')
,(1019, '<iframe width="560" height="315" src="//www.youtube.com/embed/I-EEqJ9HyTk" allowfullscreen></iframe>')
,(1020, '<iframe width="560" height="315" src="//www.youtube.com/embed/OmaI1nInDOs" allowfullscreen></iframe>')
,(1021, '<iframe width="560" height="315" src="//www.youtube.com/embed/vw61gCe2oqI" allowfullscreen></iframe>')
,(1022, '<iframe width="560" height="315" src="//www.youtube.com/embed/Z9a4PvzlqoQ" allowfullscreen></iframe>')
,(1023, '<iframe width="560" height="315" src="//www.youtube.com/embed/p56_y43UuEk" allowfullscreen></iframe>')
,(1024, '<iframe width="560" height="315" src="//www.youtube.com/embed/XcwIDLEcn2Q" allowfullscreen></iframe>')
,(1025, '<iframe width="560" height="315" src="//www.youtube.com/embed/OwlynHlZEc4" allowfullscreen></iframe>')
,(1026, '<iframe width="560" height="315" src="//www.youtube.com/embed/ll13GAE1Y2c" allowfullscreen></iframe>')
,(1027, '<iframe width="560" height="315" src="//www.youtube.com/embed/TD-F4lhMh2E" allowfullscreen></iframe>')
,(1028, '<iframe width="560" height="315" src="//www.youtube.com/embed/xvp6FnYWRZU" allowfullscreen></iframe>')
,(1029, '<iframe width="560" height="315" src="//www.youtube.com/embed/K1In45K0DGc" allowfullscreen></iframe>')
,(1030, '<iframe width="560" height="315" src="//www.youtube.com/embed/qT0aE4iAnJo" allowfullscreen></iframe>')
,(1031, '<iframe width="560" height="315" src="//www.youtube.com/embed/ZBvK6ni97W8" allowfullscreen></iframe>')
,(1032, '<iframe width="560" height="315" src="//www.youtube.com/embed/44xvWIBmtfY" allowfullscreen></iframe>')
,(1033, '<iframe width="560" height="315" src="//www.youtube.com/embed/8e2xY0pMz70" allowfullscreen></iframe>')
,(1034, '<iframe width="560" height="315" src="//www.youtube.com/embed/2fvoau0ekWk" allowfullscreen></iframe>')
,(1035, '')
,(1036, '');


--
-- Data for the SUPPORT table
--
INSERT INTO support (title, html_code)
VALUES
 ( 'Home', '<div id="mainContent"><iframe width="560" height="315" src="//www.youtube.com/embed/gsjtg7m1MMM" allowfullscreen></iframe><p id="intro">Welcome to Trippy Rodeo Movie Reviews! If you want to know about the best movies in 2014 then you\'ve come to the right place. Here you can learn everything you need to know about the top movies of 2014, from trailers and ratings to posters and fantastic reviews. Your only problem is going to be deciding on what movie to watch next!</p></div>')
,( 'Site Plan and Style Guide', '<h1>Description</h1><h2>Site Name</h2><ul><li>Trippy Rodeo</li></ul><h2>Site Purpose</h2><ul> <li>The purpose of this site is to inform people of upcoming movie releases, give a brief synopsis and trailer for all movies, and give reviews for movies that I\'ve seen.</li> </ul><h2>Target Audience:</h2><ul><li>Age: 20-50 years old</li><li>Gender: Males and Females</li><li>Economic Range: All ranges</li><li>Education: All</li><li>Access: Computer, Tablet, Laptop, Smartphone</li></ul> <h3>Persona</h3><h4>Tyler</h4><p>Meet Tyler.  Tyler is a college junior is his early twenties.  He is married with a baby boy. Tyler enjoys seeing new movies but also has a family to support.  Tyler doesn\'t spend much time online, and either uses his home desktop or his smart phone to do so.  He doesn\'t have a lot of time or money to waste and needs to be able to tell what movies are worth his money before seeing them. A person, such as Tyler, wants to watch a one of the new movies coming out this month but can\'t afford to see them all. They want a complete description and review of each movie so they know which film best suits their personality and that they would most enjoy. </p> <h4>Naomi</h4><p>Naomi is a busy mother of 4 very active children. Once a week the family rents a movie and watches it together. Naomi will come to my site so that she can see what movies will be appropriate for her younger children to watch but will also keep the older ones entertained. She comes here not only to find this out but also to save her time when she goes to RedBox or the movie store because those kids will start to cause trouble before too long.</p><h3>Scenarios</h3><ul><li>Watch trailers for upcoming movies</li><li>Read a synopsis to find out what a movie is about</li><li>Read trailers and look at our movie ratings to see how good a movie is</li><li>See what movies are coming out this month</li><li>View a list of movies for the year 2014</li><li>Get specific information about a movie such as length, MPAA rating, etc..</li></ul><br/><h2>Site Map</h2><a href="../content/images/sitemap.jpg" title="Site Map">Site Map</a><div><h2>Asset List</h2><h3>Pages</h3><p>I have 4 views for this site: a home page, login page, an individual movie review page, and a month page. The home page has a video that is a mix of several movie trailers and will welcome visitors to the site. The individual review page is the heart and soul of the site. It gives all the movie information as well as a review. If a trailer is available it will also display the trailer. The months page displays a list of all of the movies for 2014 and arranges them  by the month of their release date. The home page and review page will also contain 2 side boxes. The first contains the top rated movies of the year as decided by myself. The second box will display a list of all movie coming out within the next month.</p></div><br/><div><h1>Style Guide</h1><h2>Color and Background</h2><p>Since this is a movie review site I went with a movie theme. The site background image is movie curtains with a background color of black. The background color of the content section is silver with firebrick red and gold as secondary colors. </p><h3>Typography</h3><p>My main fonts are Georgia, Trebucht MS, Times, and the default serif.<br/>Headings are Arial and the default sans serif font.</p><h3>Navigation</h3><p>There will be a horizontal navigation bar across the top of the page, just underneath the title and logo, with buttons for the home page, months page, and login page. Once logged in the Login button will change and become an edit button to edit your own information, or others information if you are an administrator.</p><h3>Responsiveness</h3><p>From desktop or laptop to tablet there should be close to no change for the website depending on the size of the tablet.  Bigger tablets will remain the same while smaller tablets will look like the smart phone page. On the smart phone, Trippy Rodeo will be much simpler.  Items will be displayed on top of each other instead of side by side. </p></div>')
,( 'Unused', NULL)
,( '2014 Movies by Month', NULL)
,( 'Login', NULL)
,( 'Sources', '<p>Information was pulled from multiple pages on the following websites.</p><ul><li><a href="http://www.imdb.com/">IMDB</a></li><li><a href="http://www.allmovie.com/">allmovie</a></li><li><a href="https://www.youtube.com/">YouTube</a></li></ul>')
,( 'Edit Information', NULL)
,( 'Update Movie Info', NULL)
,( 'Add Movie', NULL);

--
-- Data for the USER table
--
INSERT INTO user (email, first_name, last_name, password, admin)
VALUES
 ( 'lehithomas25@gmail.com', 'Lehi', 'Thomas', '$5$rounds=25000$d55634eb4a52b626$q6ZAjrB4Ala91BLOIFj/pbc8qVZ6cBQ.cGkLcefAeJ2', 'Y');
