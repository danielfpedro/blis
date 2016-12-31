<?php
namespace App\Shell;

use Cake\Console\Shell;

use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

use WideImage\WideImage;

/**
 * Images shell command.
 */
class ImagesShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function clear() 
    {
        $posts = TableRegistry::get('posts');
        $query = $posts
            ->find('all')
            ->select('photo');

        $validImages = [];
        foreach ($query as $key => $value) {
            $validImages[] = 'original_' . $value['photo'];
            foreach ($posts->images as $k => $v) {
                $validImages[] = $k . '_' . $value['photo'];
            }
        }

        $this->out($validImages);

        $folder = new Folder(WWW_ROOT . 'files' . DS . 'images');
        $folderFiles = $folder->find('.*\.jpg', true);

        foreach ($folderFiles as $key => $value) {
            $file = new File($folder->path . DS . $value);
            if (!in_array($value, $validImages)) {
                $file->delete();
            }
        }

        $this->out('OK');
    }

    public function generateAll()
    {
        $posts = TableRegistry::get('posts');
        $query = $posts
            ->find('all')
            ->select(['id', 'img']);

        $dir = new Folder(WWW_ROOT . 'files' . DS . 'images', true, 0755);

        foreach ($query as $row) {
            
            $image = WideImage::load($row->img);

            $imageName = md5((new \Datetime())->format('Y-m-d H:i:s') . $row->img) . '.jpg';

            $image
                ->saveToFile($dir->path . DS . 'original_' . $imageName, $posts->imageQuality);

            $this->out('Salvou: ' . $dir->path . DS . 'original_' . $imageName);

            foreach ($posts->images as $key => $value) {
                $image
                    ->resize($value['w'], $value['h'], 'outside')
                    ->crop('center', 'top', $value['w'], $value['h'])
                    ->saveToFile($dir->path . DS . $key . '_' . $imageName, $posts->imageQuality);

                $this->out('Salvou: ' . $dir->path . DS . $key . '_' . $imageName);
            }
            $post = $posts->get($row->id);
            $post->photo = $imageName;
            $posts->save($post);
        }
    }
}
