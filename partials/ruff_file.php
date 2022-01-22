<?php
                $noresult=true;
                $sql="SELECT * FROM `comments` where thread_id='$id'";
                $result=mysqli_query($conn,$sql);
                while($row3=mysqli_fetch_assoc($result))
                {
                    $noresult=false;
                    $comment_content=$row3['comment_content'];
                    $comment_id=$row3['comment_id'];
                    echo'
                    <div class="flex-shrink-0">
                    <img src="/forum/img/pic1.jpg" width=35px alt="..."> 
                    <p>'.$comment_content.'</p>
                    </div>';
                }
                ?>