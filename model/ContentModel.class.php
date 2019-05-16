<?php
//内容实体类
class ContentModel extends Model{
    private $id;
    private $title;
    private $nav;
    private $attr;
    private $tag;
    private $keyword;
    private $thumbnail;
    private $info;
    private $source;
    private $author;
    private $content;
    private $commend;
    private $count;
    private $gold;
    private $sort;
    private $readlimit;
    private $color;
    private $inputkeyword;
    private $limit;


    //拦截器
    private function __set($_key,$_value){
        $this->$_key=Tool::mysqlString($_value);
    }
    //取值
    private function __get($_name){

            return $this->$_name;
    }
    public function searchTagContentTotal(){
        $_sql="SELECT COUNT(*)
        FROM
        cms_content c,
        cms_nav n
        WHERE
        c.nav=n.id
        AND
        c.tag LIKE '%$this->inputkeyword%'
        ";
        return parent::total($_sql);
    }
    public function searchKeywordContentTotal(){
        $_sql="SELECT COUNT(*)
        FROM
        cms_content c,
        cms_nav n
        WHERE
        c.nav=n.id
        AND
        c.keyword LIKE '%$this->inputkeyword%'
        ";
        return parent::total($_sql);
    }
    public function searchTitleContentTotal(){
        $_sql="SELECT COUNT(*)
        FROM
        cms_content c,
        cms_nav n
        WHERE
        c.nav=n.id
        AND
        c.title LIKE '%$this->inputkeyword%'
         ";
        return parent::total($_sql);
    }
    public function searchTagContent(){
        $_sql="SELECT
        c.id,
        c.title,
        c.title t,
        c.nav,
        c.thumbnail,
        c.attr,
        c.author,
        c.info,
        c.count,
        c.gold,
        c.keyword,
        c.date,
        n.nav_name
        FROM
        cms_content c,
        cms_nav n
        WHERE
        c.nav=n.id
        AND
        c.tag LIKE '%$this->inputkeyword%'
        ORDER BY
        c.date DESC
        $this->limit";
        return parent::all($_sql);
    }
    public function searchKeywordContent(){
        $_sql="SELECT
        c.id,
        c.title,
        c.title t,
        c.nav,
        c.thumbnail,
        c.attr,
        c.author,
        c.info,
        c.count,
        c.gold,
        c.keyword,
        c.date,
        n.nav_name
        FROM
        cms_content c,
        cms_nav n
        WHERE
        c.nav=n.id
        AND
        c.keyword LIKE '%$this->inputkeyword%'
        ORDER BY
        c.date DESC
        $this->limit";
        return parent::all($_sql);
    }
    public function searchTitleContent(){
        $_sql="SELECT
                    c.id,
                    c.title,
                    c.title t,
                    c.nav,
                    c.thumbnail,
                    c.attr,
                    c.author,
                    c.info,
                    c.count,
                    c.gold,
                    c.keyword,
                    c.date,
                    n.nav_name
                FROM
                    cms_content c,
                    cms_nav n
                WHERE
                    c.nav=n.id
                AND 
                c.title LIKE '%$this->inputkeyword%'
                ORDER BY
                    c.date DESC
                $this->limit";
        return parent::all($_sql);
    }
    //获取主栏目的11条
    public function getNewNavList(){
        $_sql="SELECT 
                            id,
                            title,
                            date 
                    FROM 
                            cms_content
                    WHERE 
                            nav in (SELECT id FROM cms_nav WHERE pid='$this->nav')
                    ORDER BY
                             date 
                    DESC
                    LIMIT
                            0,11";
        return parent::all($_sql);
    }
    //获取最新的10条
    public function getNewList(){
        $_sql="SELECT 
                        id,
                        title,
                        date 
                    FROM 
                        cms_content 
                    ORDER BY 
                        date 
                    DESC 
                    LIMIT 
                        0,10";
        return parent::all($_sql);
    }
    //获取最新头条1条
    public function getNewTop(){
        $_sql="SELECT 
                        id,
                        title,
                        info 
                    FROM 
                        cms_content 
                    WHERE 
                        attr 
                    LIKE 
                        '%头条%' 
                    ORDER BY 
                        date 
                    DESC 
                    limit 
                            1";
        return parent::one($_sql);
    }
    //获取头条2-5
    public function getNewTopList(){
        $_sql="SELECT
                        id,
                        title,
                        info
                    FROM
                        cms_content
                    WHERE
                        attr
                    LIKE
                        '%头条%'
                    ORDER BY
                        date
                    DESC
                    limit
                            1,4";
        return parent::all($_sql);
    }
    //获取最新的4条图文
    public function getPicList(){
        $_sql="SELECT 
                        id,
                        title,
                        thumbnail 
                    FROM 
                        cms_content 
                    WHERE 
                        thumbnail<>'' 
                    ORDER BY 
                        date 
                    DESC
                    LIMIT
                            0,4";
        return parent::all($_sql);
    }
    //本月评论总榜，7条
    public function getMonthCommentList(){
        $_sql="SELECT
                        ct.id,
                        ct.title,
                        ct.date
                    FROM
                        cms_content ct
                    WHERE
                        MONTH(NOW())=DATE_FORMAT(ct.date,'%c')
                    ORDER BY
                        (SELECT COUNT(*) FROM cms_comment c WHERE c.cid=ct.id)
                    DESC
                    LIMIT
                        0,7";
        return parent::all($_sql);
    }
    //获取本月热点（点击量）,总排行，7条
    public function getMonthHotList(){
        $_sql="SELECT 
                        id,
                        title,
                        date 
                    FROM 
                        cms_content 
                    WHERE
                        MONTH(NOW())=DATE_FORMAT(date,'%c')
                    ORDER BY 
                        count 
                    DESC
                    LIMIT
                        0,7";
        return parent::all($_sql);
    }
    //获取最新的7条推荐文档
    public function getNewRecList(){
        $_sql="SELECT 
                        id,
                        title,
                        date 
                FROM 
                        cms_content 
                WHERE 
                        attr 
                LIKE 
                        '%推荐%' 
                ORDER BY 
                        date 
                DESC
                LIMIT 
                        0,7";
        return parent::all($_sql);
    }
    //获取本月、本类、图文排行榜 10条
    public function getMonthNavPic(){
        $_sql="SELECT
                    ct.id,
                    ct.title,
                    ct.date
                FROM
                    cms_content ct
                WHERE
                    thumbnail<>''
                AND
                    MONTH(NOW())=DATE_FORMAT(date,'%c')
                AND
                    ct.nav in($this->nav)
                ORDER BY
                    date
                DESC
                LIMIT
                    0,10";
        return parent::all($_sql);
    }
    //获取本月、本类、热点排行榜 10条
    public function getMonthNavHot(){
        $_sql="SELECT
                        ct.id,
                        ct.title,
                        ct.date
                    FROM
                        cms_content ct
                    WHERE
                        MONTH(NOW())=DATE_FORMAT(date,'%c')
                    AND
                        ct.nav in($this->nav)
                    ORDER BY
                        (SELECT COUNT(*) FROM cms_comment c WHERE c.cid=ct.id)
                    DESC
                    LIMIT
                        0,10";
        return parent::all($_sql);
    }
    //获取本月、本类、推荐排行榜 10条
    public function getMonthNavRec(){
        $_sql="SELECT 
                        id,
                        title,
                        date 
                    FROM 
                        cms_content 
                    WHERE 
                        attr LIKE '%推荐%'
                    AND
                        MONTH(NOW())=DATE_FORMAT(date,'%c')
                    AND 
                        nav in($this->nav)
                    ORDER BY 
                        date 
                    DESC 
                    LIMIT 
                        0,10";
        return parent::all($_sql);
    }
    //获取总排行榜文档的，评论量，从大到小
    public function getHotTwentyComment(){
        $_sql="SELECT
                        ct.id,
                        ct.title
                    FROM
                        cms_content ct
                    ORDER BY
                        (SELECT COUNT(*) FROM cms_comment c WHERE c.cid=ct.id) DESC
                    LIMIT
                        0,20";
        return parent::all($_sql);
    }
    
    public function  getListContentTotal(){
        $_sql="SELECT COUNT(*) 
                            FROM 
                                cms_content c,
                                cms_nav n
                            WHERE
                                c.nav=n.id
                            AND
                                nav in ($this->nav)";
        return parent::total($_sql);
    }
    //累计文档的点击量
    public function setContentCount(){
        $_sql="UPDATE 
                        cms_content 
                    SET 
                        count=count+1 
                    WHERE 
                        id='$this->id' 
                    LIMIT 
                        1";
        return parent::aud($_sql);
    }
    //获取文档列表
    public function getListContent(){
        $_sql="SELECT 
                    c.id,
                    c.title,
                    c.title t,
                    c.nav,
                    c.thumbnail,
                    c.attr,
                    c.author,
                    c.info,
                    c.count,
                    c.gold,
                    c.keyword,
                    c.date,
                    n.nav_name 
                FROM 
                    cms_content c,
                    cms_nav n
                WHERE
                    c.nav=n.id
                AND
                    nav in ($this->nav)
                ORDER BY
                    c.date DESC
                 $this->limit";
        return parent::all($_sql);
        
    }
    //获取单一文档内容
    public function getOneContent(){
        $_sql="SELECT 
                        id,
                        title,
                        tag,
                        keyword,
                        thumbnail,
                        content,
                        nav,
                        info,
                        date,
                        count,
                        source,
                        author,
                        gold,
                        color,
                        sort,
                        readlimit,
                        commend,
                        attr
                 FROM 
                        cms_content
                 WHERE
                        id='$this->id'";
        return parent::one($_sql);
    }
    public function addContent(){
        
       echo $_sql="INSERT INTO cms_content(
                                    title,
                                    nav,
                                    attr,
                                    tag,
                                    keyword,
                                    thumbnail,
                                    info,
                                    source,
                                    author,
                                    content,
                                    commend,
                                    count,
                                    gold,
                                    color,
                                    sort,
                                    readlimit,
                                    date
                         ) values(
                                    '$this->title',
                                    '$this->nav', 
                                    '$this->attr',
                                    '$this->tag',
                                    '$this->keyword',
                                    '$this->thumbnail',
                                    '$this->info',
                                    '$this->source',
                                    '$this->author',
                                    '$this->content',
                                    '$this->commend',
                                    '$this->count',
                                    '$this->gold',
                                    '$this->sort',
                                    '$this->readlimit',
                                    '$this->color',
                                    NOW()
                                 )";
        return parent::aud($_sql);
        
    }
    //修改文档
    public function updateContent(){
        $_sql="UPDATE
                    cms_content 
                SET 
                    title='$this->title',
                    nav='$this->nav', 
                    attr='$this->attr',
                    tag='$this->tag',
                    keyword='$this->keyword',
                    thumbnail='$this->thumbnail',
                    info='$this->info',
                    source='$this->source',
                    author='$this->author',
                    content='$this->content',
                    commend='$this->commend',
                    count='$this->count',
                    gold='$this->gold',
                    sort='$this->sort',
                    readlimit='$this->readlimit',
                    color='$this->color'
                WHERE 
                    id='$this->id' 
                LIMIT 
                     1";
        return parent::aud($_sql);
        
    }
    public function deleteContent(){
        $_sql="DELETE FROM cms_content WHERE id='$this->id'";
        return parent::aud($_sql);
    }

}