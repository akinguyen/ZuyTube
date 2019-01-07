<?php
class videoDetail
{
    private $username, $date, $description, $category;
    public function createVideoDetail()
    {
        $url = "profile.php?username=" . $this->username;
        return "
        <div class='mb-3' width='width: 350px'>
          <div class='card'>

            <div class='card-img-top'>
                <a href='$url' class='ml-2 mt-2 d-inline float-left'>
                <img
                 src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShci2i08psVXKRwGLnhzTe5T9KeyO1cv_zq0nNf0DZ7c5ME00hOQ'
                  alt='Card image cap'
                  style='width: 100px'
                  class=' rounded-circle mx-auto mt-2 border border-dark d-inline'
                />
                </a>
              <div class='ml-2 mt-3 float-left'>
                <h6 class=''>$this->username</h6>
                <h6 style='font-size: 10px'>
                  $this->date
                </h6>
                <h6 style='font-size: 10px'>
                  Category: $this->category
                </h6>
              </div>
            </div>

            <div class='card-body mr-5' style='width: auto'>
              <div class='container'>
                <p class='mt-4 display-5'>$this->description</p>
              </div>
            </div>


          </div>

        </div>";
    }
    public function __construct($username, $date, $description, $category)
    {
        $this->username = $username;
        $this->date = $date;
        $this->description = $description;
        $this->category = $category;
    }
}
