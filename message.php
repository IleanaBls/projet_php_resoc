<article>
                        <h3>
                            <datetime>
                            <?php
                            $time = strtotime($post['created']);
                            $newformat = date('d/m/Y à H:i',$time);
                            echo $newformat;
                            ?> </datetime>
                        </h3>
                        <address>par <?php echo $post['author_name'];?></address>
                        <div>
                            <p><?php echo $post['content'] ;?></pre></p>
                        </div>
                        <footer>
                            <small>♥ <?php echo $post['like_number'];?></small>
                            <?php
                                $tags = explode(',', $post['taglist']);
                                foreach ($tags as &$tag) {
                                    echo "<a href='#'>#$tag</a>, ";
                                }
                            
                        ?>

                            
                        </footer>
                    </article>