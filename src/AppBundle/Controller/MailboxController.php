<?php

namespace AppBundle\Controller;

use AppBundle\Services\MailboxService;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MailboxController
 *
 * @package AppBundle\Controller
 */
class MailboxController extends FOSRestController
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $page   = $request->get('page', 1);
        $filter = $request->get('filter', null);

        /** @var MailboxService $mailboxService */
        $mailboxService = $this->get('mailbox');

        $view = $this->view($mailboxService->listAll($filter, 10, $this->getOffset($page)));

        return $this->handleView($view);
    }

    /**
     * @param $page
     *
     * @return int
     */
    protected function getOffset($page)
    {
        return (intval($page) - 1) * 10;
    }
}
