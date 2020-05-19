<?php

namespace SimplifiedMagento\FirstModule\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class HelloWorld extends Command
{
	public function configure() {
		$this->setName('firstmodule:helloworld');
		$this->setDescription('the command print out hellow world');

		$this->setDefinition([
			new InputArgument("name", InputArgument::OPTIONAL, "the name of the person", null, null)
		]);

		parent::configure();
	}

	public function execute(InputInterface $input, OutputInterface $output) {
		$output->writeln("Hello World,".$input->getArgument('name'));
	}
}