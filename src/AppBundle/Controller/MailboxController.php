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
        $offset = $this->getOffset($request->get('page', 1));

        /** @var MailboxService $mailboxService */
        $mailboxService = $this->get('mailbox');

        $view = $this->view($mailboxService->listAll(10, $offset));

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
