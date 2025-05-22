package tests;

import org.junit.Before;
import org.junit.Test;
import org.openqa.selenium.support.ui.ExpectedConditions;

import testdata.URLs;
import utils.RandomGenerator;

public class TestCase1 extends BaseTest{

	@Before
	public void before() {
		super.before();
	}
	
	@Test
	public void test() throws InterruptedException {

		for(int i = 0; i <= 40; i++) {
			mainPage.insertNrInamtriculare(RandomGenerator.stringValue(7));
			mainPage.insertObservatii(RandomGenerator.stringValue(255));
			mainPage.insertVIN(RandomGenerator.stringValue(17));
			mainPage.selectTipPrestatie(1);
			mainPage.clickSubmit();
		}
		
	}

}
