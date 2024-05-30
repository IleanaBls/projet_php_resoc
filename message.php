<article>
                        <h3>
                            <datetime>
                            <?php
                            $time = strtotime($post['created']);
                            $newformat = date('d/m/Y à H:i',$time);
                            echo $newformat;
                            ?> </datetime>
                        </h3>
                        <?php  $postI = $post['user_id']; 
                        ?>
                        <adress><a href= "wall.php?user_id=<?php echo $postI;?>"></adress>
                        </a>    
                        <div>
                            <p><?php echo $post['content'] ;?></pre></p>
                        </div>
                        <footer>
                            <small>♥ <?php echo $post['like_number'];?></small>
                            <?php
                                $tags = explode(',', $post['taglist']);
                                foreach ($tags as &$tag) {
                                    
                    ?> 
                    <a href='http://localhost/resoc_n1/tags.php?tag_id=<?php echo $post["tag_id"]?>'>#<?php echo($tag)?></a>,
                <?php
            }
            ?>
                                
                               
                            
                    
                            
                        

                            
                        </footer>
                    </article>