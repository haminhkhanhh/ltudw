<?
    //Vẽ thanh điều hướng phân trang
    class Pagination {
        //biến chứa cấu hình
        private $config = [
            'total' => 0,
            'limit' => 0,
            'full' => true, //biến này dùng để xử lí việc phân trang dài đằng đẳng
            'querystring' => 'page' // index.php?page=3, querystring là trang thì có thể truyền vào trang,... cho người dùng truyền tham số vào
        ];
        public function __construct($config=[]) //đón config do người dùng gửi vào
        {
            $condition1 = isset($config['limit']) && $config['limit'] < 0;
            $condition2 = isset($config['total']) && $config['total'] < 0;
            if ($condition1 || $condition2) {
                die('limit và total không được nhỏ hơn 0');
            }
            if(!isset($config['querystring'])) {
                $config['querystring'] = 'page';
            }
            $this->config = $config;
        }
        //tính tổng số trang
        private function gettotalPage() { // với 100 rc mỗi page 8 rc thì được bao nhiêu trang
            $total = $this->config['total'];
            $limit = $this->config['limit'];
            return ceil($total / $limit); //hàm làm tròn lên
        }
        //lấy trang hiện tại
        private function getCurrentPage() { //hứng param_name để xử lí
            if (isset($_GET[$this->config['querystring']]) && (int)$_GET[$this->config['querystring']] >= 1) {
                $t = (int)$_GET[$this->config['querystring']];
                if ($t > $this->gettotalPage()) { //Kiếm tra người dùng có nhập > số totalPage không
                    return (int)$this->gettotalPage();
                }
                else {
                    return $t;
                }
            }
            else {
                return 1;
            }
        }
        //lấy trang trước
        private function getPrePage() { //
            if ($this->getCurrentPage() === 1) {
                return;
            }
            else { //php_self -> lấy khúc index.php thay bằng trang hiện tại - VD: bantin.php?page=1. Thẻ a phần class="text" là bỏ dấu chấm trong thẻ li
                return '<li class="item"><a class="text" href="' . $_SERVER['PHP_SELF'] . '?' . 
                $this->config['querystring'] . "=" . ($this->getCurrentPage() - 1) . '" >Previous</a></li>';
            }
        }
        //lấy trang sau
        private function getNextPage() {
            if ($this->getCurrentPage() >= $this->gettotalPage()) {
                return;
            }
            else {
                //còn không thì trả về HTML code
                return '<li class="item"><a class="text" href="' . $_SERVER['PHP_SELF'] . '?' . 
                $this->config['querystring'] . "=" . ($this->getCurrentPage() + 1) . '" >Next</a></li>';
            }
        }
        //vẽ thanh chuyển trang //cho phép ở bên ngoài gọi tới hàm này
        public function getPagination() {
            $data = '';
            //giới hạn hay không ?
            if (isset($this->config['full']) && $this->config['full'] === false) {
                //.= là nối chuỗi
                $data .= ($this->getCurrentPage() - 3) > 1 ? 
                        '<li class="item">...</li>' : '';
                $current = ($this->getCurrentPage() - 3) > 0 ?
                            ($this->getCurrentPage() - 3) : 1;
                $total = (($this->getCurrentPage() + 3) > $this->gettotalPage() ?
                    $this->gettotalPage() : ($this->getCurrentPage() + 3));

                for ($i = $current; $i <= $total; $i++) {
                    if ($i === $this->getCurrentPage()) {
                        $data .='<li class="item"><a href="#" class="text">' . $i . '</a></li>';
                    }
                    else {
                        $data .= '<li class="item"><a class="text" href="' . 
                                $_SERVER['PHP_SELF'] . '?' .
                                $this->config['querystring'] . '=' .
                                $i . '" >' . $i . '</a></li>';
                    }
                }
                $data .= ($this->getCurrentPage() + 3) < $this->gettotalPage() ?
                '<li class="item">...</li>' : '';
            }
            else {
                for ($i = 1; $i <= $this->gettotalPage(); $i++) {
                    if ($i === $this->getCurrentPage()) {
                        $data .= '<li class="item">< href="#">' .
                         $i . '</a></li>';
                    }
                    else {
                        $data .= '<li class="item"><a class="text" href="' .
                        $_SERVER['PHP_SELF'] . '?' . $this->config['querystring'] . '=' .
                        $i . '">' . $i .'</a></li>';
                    }
                }
            }
            return '<ul class="main-nav">' . $this->getPrePage() .
                    $data . $this->getNextPage() . '</ul>';
        }
    }
?>