package tests;

import java.time.Duration;

import org.junit.AfterClass;
import org.junit.Assert;
import org.junit.Before;
import org.junit.BeforeClass;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

import pages.MainPage;
import testdata.URLs;

public class BaseTest {
	
	static WebDriver driver;
	static WebDriverWait wait;
	static MainPage mainPage;

	@BeforeClass
	public static void setUp() {
		ChromeOptions chromeOption = new ChromeOptions();
		chromeOption.addArguments("--remote-allow-origins=*","ignore-certificate-errors");
		chromeOption.addArguments("disable-infobars"); // Disable infobars
		chromeOption.addArguments("disable-popup-blocking"); // Disable popup blocking
		chromeOption.addArguments("disable-default-apps"); // Disable default apps
		chromeOption.addArguments("guest"); // Disable change password popup
		chromeOption.addArguments("no-first-run"); // Skip first run wizards
		chromeOption.addArguments("no-default-browser-check"); // Skip default browser check
		chromeOption.addArguments("--disable-search-engine-choice-screen");
		
		chromeOption.addArguments("start-maximized"); // Open browser in maximized mode
		chromeOption.addArguments("disable-notifications"); // Disable notifications
		chromeOption.addArguments("disable-extensions"); // Disable extensions

		System.setProperty("webdriver.chrome.driver","src/resources/chromedriver.exe");
		
		driver = new ChromeDriver(chromeOption);
		
		//wait implicit
		driver.manage().timeouts().implicitlyWait(Duration.ofSeconds(10));
		
		// Maximize
		driver.manage().window().maximize();
		
		// Init wait
		wait = new WebDriverWait(driver, Duration.ofSeconds(30));
		
		// Init pages
		mainPage = new MainPage(driver);
		
	}
	
	@AfterClass
	public static void tearDown(){
		driver.close();
	}
	
	@Before
	public void before() {
		driver.get(URLs.MAIN);
		wait.until(ExpectedConditions.urlMatches(URLs.MAIN));
		Assert.assertEquals(URLs.MAIN, driver.getCurrentUrl());
	}

}
