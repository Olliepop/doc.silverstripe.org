<?php
/**
 * @package sapphiredocs
 */
class DocumentationEntityTest extends SapphireTest {
	
	function testDocumentationEntityAccessing() {
		$entity = new DocumentationEntity('docs', '1.0', '../sapphiredocs/tests/docs/', 'My Test');
		
		$this->assertEquals($entity->getTitle(), 'My Test');
		$this->assertEquals($entity->getVersions(), array('1.0'));
		$this->assertEquals($entity->getLanguages(), array('en', 'de'));
		$this->assertEquals($entity->getModuleFolder(), 'docs');
		
		$this->assertTrue($entity->hasVersion('1.0'));
		$this->assertFalse($entity->hasVersion('2.0'));
		
		$this->assertTrue($entity->hasLanguage('en'));
		$this->assertFalse($entity->hasLanguage('fr'));
	}
	
	function testgetLatestVersion() {
		$entity = new DocumentationEntity('docs', '1.0', '../sapphiredocs/tests/docs/', 'My Test');
		$entity->addVersion('1.1', '../sapphiredocs/tests/docs-v2.4/');
		$entity->addVersion('0.0', '../sapphiredocs/tests/docs-v3.0/');
		$this->assertEquals('1.1', $entity->getLatestVersion(), 'Automatic version sorting');
		
		$entity = new DocumentationEntity('docs', '1.0', '../sapphiredocs/tests/docs/', 'My Test');
		$entity->addVersion('1.1.', '../sapphiredocs/tests/docs-v2.4/');
		$entity->setLatestVersion('1.0');
		$this->assertEquals('1.0', $entity->getLatestVersion(), 'Manual setting');
	}
}