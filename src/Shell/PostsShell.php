<?php
namespace App\Shell;

use Cake\Console\Shell;

use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Posts shell command.
 */
class PostsShell extends Shell
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
    public function main()
    {
        $this->out($this->OptionParser->help());
    }

    public function setOneMoreViewForAll($prod = false)
    {
        $connectionToUse = $prod ? 'kinghost' : 'default';
        $connection = ConnectionManager::get($connectionToUse);
        
        $posts = TableRegistry::get('posts', ['connection' => $connection]);

        $rows = $posts->find('all');
        foreach ($rows as $row) {
            $row->views = ($row->view + 1);
            $row->view_timestamp = (new \Datetime())->format('Y-m-d H:i:s');
            $posts->save($row);
        }

        $this->out('Done!');
    }
}
