<?php

namespace Helsinque\Tests\Validators;

use Validators\Cpf\ValidateCpf;
use Exceptions\DocumentValidationException;


class ValidatorCpfTest extends \PHPUnit_Framework_TestCase
{
	public function testValidatorCNPJ()
	{
		$validator = new  ValidateCpf();

		$this->assertInstanceOf(ValidateCpf::class, $validator);

	}

	public function testEqualsCPF()
	{
		$validator = new  ValidateCpf();

		$this->assertEquals("154.155.160-50", $validator->ValidateCpf("154.155.160-50")->getValidation());
	}

	public function testValidateCpfWithoutSeparate()
    {
        $validator = new Validatecpf();

        $this->assertEquals("15415516050",$validator->validateCpf("15415516050")->getValidation());
    }

    /**
	 * @expectedException Exceptions\DocumentValidationException
	 */
    public function testValidateCnpjInvalid()
    {
        $validator = new ValidateCpf();

        $validator->validateCpf("154.155.369-50")->getValidation();
    }	

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testValidateCnpjNonStandardSize()
	{

		$instance = new ValidateCpf();
        
		$this->invokeMethod($instance, 'assertCPF', array('154.155.160-5023343'));

	}

	/**
	 * Call protected/private method of a class.
	 *
	 * @param object &$object    Instantiated object that we will run method on.
	 * @param string $methodName Method name to call
	 * @param array  $parameters Array of parameters to pass into method.
	 *
	 * @return mixed Method return.
	 */
	public function invokeMethod(&$object, $methodName, array $parameters = array())

	{

	    $reflection = new \ReflectionClass(get_class($object));
	    $method = $reflection->getMethod($methodName);
	    $method->setAccessible(true);

	    return $method->invokeArgs($object, $parameters);
	}
	
}