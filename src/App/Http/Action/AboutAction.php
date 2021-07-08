<?php

namespace App\Http\Action;

use Laminas\Diactoros\Response\HtmlResponse;

class AboutAction
{
	public function __invoke() : HtmlResponse
	{
		return new HtmlResponse( phpinfo( INFO_ALL ) );
	}
}