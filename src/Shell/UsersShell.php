<?php
namespace App\Shell;

use Cake\Console\Shell;

use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Users shell command.
 */
class UsersShell extends Shell
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

    public function changePassword($id, $newPassword, $prod = false)
    {
        $connectionToUse = $prod ? 'kinghost' : 'default';
        $connection = ConnectionManager::get($connectionToUse);
        $users = TableRegistry::get('users', ['connection' => $connection]);

        $user = $users->get($id);

        $user->password = $newPassword;

        $users->save($user);

        $this->out('Done!');
    }
}
