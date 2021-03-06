<?php

namespace spec\Snt\Capi\Repository\Article;

use PhpSpec\ObjectBehavior;
use Snt\Capi\Http\HttpRequestParameters;
use Snt\Capi\PublicationId;
use Snt\Capi\Repository\Article\FindParameters;
use Snt\Capi\Repository\FindParametersInterface;

/**
 * @mixin FindParameters
 */
class FindParametersSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FindParameters::class);
        $this->shouldImplement(FindParametersInterface::class);
    }

    function it_creates_find_parameters_for_publication_id_and_article_id()
    {
        $this->beConstructedThrough('createForPublicationIdAndArticleId', [PublicationId::SA, 1]);

        $this->getPublicationId()->shouldReturn(PublicationId::SA);
        $this->getArticleId()->shouldReturn(1);
    }

    function it_builds_http_request_parameters()
    {
        $this->beConstructedThrough('createForPublicationIdAndArticleId', [PublicationId::SA, 1]);

        $path = sprintf('publication/%s/articles/%s', PublicationId::SA, '1');

        $expectedHttpRequestParameters = HttpRequestParameters::createForPath($path);

        $this->buildHttpRequestParameters()->shouldBeLike($expectedHttpRequestParameters);
    }
}
