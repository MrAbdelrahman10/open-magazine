<?php


/**
 * Description of RSSWriter
 *
 * @author MrAbdelrahman10
 */
class RSSWriter {

    public $Name = 'feed';
    public $Encode = 'UTF-8';
    public $Title = "";
    public $Description = "";
    public $Language = "ar-eg";
    public $Copyright = "";
    public $Items = array();

    public function Create() {
        $rssfeed = '<?xml version="1.0" encoding="' . $this->Encode . '"?>';
        $rssfeed .= '<rss version="2.0">';
        $rssfeed .= '<channel>';
        $rssfeed .= '<title>' . $this->Title . '</title>';
        $rssfeed .= '<link>' . SITE_URL . '</link>';
        $rssfeed .= '<description>' . $this->Description . '</description>';
        $rssfeed .= '<language>' . $this->Language . '</language>';
        $rssfeed .= '<copyright>' . $this->Copyright . '</copyright>';

        foreach ($this->Items as $i) {
            $rssfeed .= '<item>';
            $rssfeed .= '<title>' . $i['Title'] . '</title>';
            $rssfeed .= '<description>' . GetTextFromHTML($i['Description']) . '</description>';
            $rssfeed .= '<link>' . GetRewriteUrl('news/i/' . $i['ID']) . '</link>';
            $rssfeed .= '<enclosure url="' . SITE_URL . $i['Picture'] . '" length="5000" type="image/jpge"/>';
            $rssfeed .= '<pubDate>' . GetDateValue($i['CreatedDate'], DATE_RSS) . '</pubDate>';
            $rssfeed .= '</item>';
        }

        $rssfeed .= '</channel>';
        $rssfeed .= '</rss>';

        $File = BASE_DIR . 'RSS/' . $this->Name . '.xml';

        $Handle = @fopen($File, 'w');
        @fwrite($Handle, $rssfeed);
        @fclose($Handle);
        }

    public function Clear() {
        $Files = glob(BASE_DIR . 'RSS/*.*');
        if ($Files) {
            foreach ($Files as $F) {
                if (file_exists($F)) {
                    unlink($F);
                    clearstatcache();
                }
            }
        }
    }

}