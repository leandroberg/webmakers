        <?php get_header() ?>
        
        <main>
            
            <!-- SLIDESHOW //-->
            <section id="slideshow">
                <div class="container-fluid">
                    <div class="row slick">
                        <?php $wpQuery = new WP_Query(array('post_type'=>'slide','nopaging'=>true));
                        while($wpQuery->have_posts()):$wpQuery->the_post(); ?>
                        <div class="col-md-12 item cover" style="background-image:url(<?php the_post_thumbnail_url('full') ?>)">
                            <div class="row justify-content-center min-height-100vh">
                                <div class="col-md-10 align-self-center">
                                    <h2><?php the_title() ?></h2>
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <?php the_content() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; wp_reset_query(); ?>
                    </div>
                </div>
            </section>
            
            <!-- ABOUT US //-->
            <section id="about-us">
                <div class="container">
                    <div class="row justify-content-center min-height-80vh">
                        <div class="col-md-10 align-self-center">
                            <?php $wpQuery->query(array('page_id'=>2)); $wpQuery->the_post(); ?>
                            <h2><?php the_title() ?></h2>
                            <figure class="cover featured-image" style="background-image:url(<?php the_post_thumbnail_url('full') ?>)"></figure>
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <?php the_content(); wp_reset_query(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- SERVICES //-->
            <section id="services">
                <div class="container">
                    <div class="row justify-content-center min-height-80vh">
                        <div class="col align-self-center">
                            <h2>Services</h2>
                            <div class="row">
                                <?php $wpQuery = new WP_Query(array('post_type'=>'services','nopaging'=>true));
                                while($wpQuery->have_posts()):$wpQuery->the_post(); ?>
                                <div class="col-md-4">
                                    <span class="fa <?php the_field('icon') ?>"></span>
                                    <?php the_content() ?>
                                </div>
                                <?php endwhile; wp_reset_query(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- CLIENTS //-->
            <section id="clients">
                <div class="container">
                    <div class="row justify-content-center min-height-80vh">
                        <div class="col-md-10 align-self-center">
                            <?php $wpQuery->query(array('page_id'=>14)); $wpQuery->the_post(); ?>
                            <h2><?php the_title() ?></h2>
                            <div class="row justify-content-center">
                                <div class="col-md-10"><?php the_content(); wp_reset_query(); ?></div>
                            </div>
                            
                            <!-- MENU ESTATES //-->
                            <nav>
                                <ul>
                                    <?php $terms = get_terms(array('taxonomy'=>'clients_category'));
                                    $n=0;
                                    foreach($terms as $term): ?>
                                    <li><a href="javascript:void(0)" data-slick="<?php echo $n ?>" <?php if($n==0) echo 'class="active"' ?> ><?php echo $term->name ?></a></li>
                                    <?php $n++; endforeach; ?>
                                </ul>
                            </nav>
                            
                            <!-- LOGOS //-->
                            <div class="row justify-content-center no-gutters">
                                <div class="col">
                                    <div class="slick">
                                        <?php foreach($terms as $term): ?>
                                        <div class="item">
                                            <ul>
                                                <?php $args = array('post_type'=>'clients','nopaging'=>true,'tax_query'=>array(array('taxonomy'=>'clients_category','field'=>'slug','terms'=>$term->slug)));
                                                $wpQuery->query($args);
                                                while($wpQuery->have_posts()):$wpQuery->the_post(); ?>
                                                <li><?php the_post_thumbnail() ?></li>
                                                <?php endwhile; wp_reset_query(); ?>
                                            </ul>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- CONTACT //-->
            <section id="contact">
                <div class="container">
                    <div class="row justify-content-center min-height-80vh">
                        <div class="col-md-6 align-self-center">
                            <h2>Contact</h2>
                            <form name="contact" class="ajaxform">
                                <input type="hidden" name="from" value="contato@virtuemasters.com.br" />
                                <input type="hidden" name="to" value="leandrobschulz@gmail.com" />
                                <input type="hidden" name="subject" value="Nova Mensagem WebMakers" />
                                <input type="text" name="nome" placeholder="type your name" required />
                                <input type="email" name="email" placeholder="your email" required />
                                <textarea name="mensagem" placeholder="and your message" required></textarea>
                                <input type="submit" value="submit your message" />
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            
        </main>
        
        <?php get_footer() ?>