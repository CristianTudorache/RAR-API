package pages;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.Select;

public class MainPage {
	
	// Init Obj
	WebDriver driver;
	
	// Init vars
	private By inputImage = By.id("image-upload");
	private By inputDate = By.id("getDataPrestatie");
	private By inputNrInmatriculare = By.id("inputNrinmatriculare");
	private By inputObservatii = By.id("getObservatii");
	private By inputVIN = By.id("inputvin");
	private By selectPrestatie = By.id("selectPrestatii");
	private By pressButton = By.id("btnTrimiteFormular");
	
	// Methods
	public void clickInsertImage() {
		driver.findElement(inputImage).click();
	}
	
	public void insertNrInamtriculare(String stringNr) {
		driver.findElement(inputNrInmatriculare).sendKeys(stringNr);
	}
	
	public void insertObservatii(String strObs) {
		driver.findElement(inputObservatii).sendKeys(strObs);
	}
	
	public void insertVIN(String strVIN) {
		driver.findElement(inputVIN).sendKeys(strVIN);
	}
	
	public void clickSubmit() {
		driver.findElement(pressButton).click();
	}
	
	public void insertDate(int zi, int luna, int an) {
		driver.findElement(inputDate).sendKeys(zi + "/" +luna +"/" +an);
	}
	
	public void selectTipPrestatie(int i) {
		WebElement element = driver.findElement(selectPrestatie);
		Select objSelect = new Select(element);
		objSelect.selectByIndex(i);
	}
	
	// Constructor
	public MainPage(WebDriver driver) {
		this.driver = driver;
	}
}
