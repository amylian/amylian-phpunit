<?php

/*
 * BSD 3-Clause License
 * 
 * Copyright (c) 2018, Abexto - Helicon Software Development / Amylian Project
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * 
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 * 
 * * Neither the name of the copyright holder nor the names of its
 *   contributors may be used to endorse or promote products derived from
 *   this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 */

namespace amylian\phpunit\tests;

require_once __DIR__ . '/../../src/compatibility.inc.php';

/**
 * Description of AssertsTest
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
class AssertsTest extends \PHPUnit\Framework\TestCase
{

    use \amylian\phpunit\traits\AssertClassExistsTrait;

    public function testAssertClassExistsForExisting()
    {
        $this->assertClassExists(\PHPUnit\Framework\Constraint\IsAnything::class);
    }

    public function testAssertClassExistsForNonExisting()
    {
        try {
            $this->assertClassExists(\foo\bar\whatever\Classname::class);
        } catch (\PHPUnit\Framework\AssertionFailedError $e) {
            return;
        }
        throw new \PHPUnit\Framework\AssertionFailedError(__METHOD__ . ' did not fail as expected');
    }

    public function testEqualsObjectData()
    {
        $o1 = new ObjectData(1, 2, 3, new ObjectData(11, 12, 13, null));
        $o2 = new ObjectData(1, 2, 3, new ObjectData(11, 12, 13, null));
        $this->assertEquals($o1, $o2);
    }

    public function testEqualsObjectDataFailing()
    {
        try {
            $o1 = new ObjectData(1, 2, 3, new ObjectData(11, 12, 13, null));
            $o2 = new ObjectData(1, 2, 3, new ObjectData(11, 12, 999999999, null));
            $this->assertEquals($o1, $o2);
        } catch (\PHPUnit\Framework\AssertionFailedError $e) {
            return;
        }
        throw new \PHPUnit\Framework\AssertionFailedError(__METHOD__ . ' did not fail as expected');
    }

}

/*
 * Class for Tests
 */

class ObjectData
{

    public $pub          = null;
    protected $prot      = null;
    private $priv        = null;
    protected $subObject = null;
    
    

    public function __construct($pub, $prot, $priv, $subObject)
    {
        $this->pub       = $pub;
        $this->prot      = $prot;
        $this->priv      = $priv;
        $this->subObject = $subObject;
    }

}
