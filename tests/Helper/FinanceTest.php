<?php
/**
 * Created by IntelliJ IDEA.
 * User: brynnlow
 * Date: 12/06/18
 * Time: 8:31
 */

namespace Tests\Helper;
use AppBundle\Entity\Article;
use AppBundle\Helper\Finance;
use PHPUnit\Framework\TestCase;

class FinanceTest extends TestCase
{
    public function testComputePriceWithVAT_1() {
        $article = new Article();
        $article->setName('article #1');
        $article->setPrice(1);

        $result = Finance::computePriceWithVAT($article->getPrice(), Article::TVA_1);

        $this->assertEquals(1.12, $result);
    }

    public function testComputePriceWithVAT_2() {
        $article = new Article();
        $article->setName('article #1');
        $article->setPrice(1);
        $result = Finance::computePriceWithVAT($article->getPrice(), Article::TVA_2);
        $this->assertEquals(1.21, $result);
    }
}