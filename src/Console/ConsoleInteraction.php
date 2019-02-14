<?php

declare(strict_types=1);

namespace App\Console;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class ConsoleInteraction
{
    /** @var SymfonyStyle */
    private $symfonyStyle;
    /**
     * @var InputInterface
     */
    private $input;
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->symfonyStyle = new SymfonyStyle($input, $output);
        $this->input = $input;
        $this->output = $output;
    }

    public function askYesNo(string $message): bool
    {
        $question = new Question($message);
        $question->setAutocompleterValues(['Oui', 'Non']);

        do {
            $result = $this->symfonyStyle->askQuestion($question);
        } while (!in_array($result, ['Oui', 'Non'], true));

        return $result === 'Oui';
    }

    public function gameSay(string $message): void
    {
        $this->symfonyStyle->writeln('<info>[Game] : ' . $message . '</info>');
    }

    public function displayWheels(CaseRoulette $finalResult, array $cases): void
    {
        $output = $this->output;
        $progressBar = new ProgressBar($output);
        $progressBar->setBarWidth(37);
        $progressBar->setFormat('.    %message%  %bar% %message%    .');
        $progressBar->setBarCharacter('͜ ');
        $progressBar->setEmptyBarCharacter('͜ ');
        $progressBar->setProgressCharacter('●');
        $progressBar->start();


        $colorText = ['Rouge' => 'red', 'Noir' => 'black'];
        foreach(range(0, random_int(100, 180)) as $value) {
            usleep(10000+ $value*600);

            $case = $cases[$value % count($cases)];

            $progressBar->advance();
            $progressBar->setMessage(sprintf('<fg=%s;bg=white;options=bold>%s</>',
                $colorText[$case->getColor()],
                $case->getNumber()
            ));
        }

        $progressBar->setMessage(sprintf('<fg=%s;bg=white;options=bold>%s</>',
            $colorText[$finalResult->getColor()],
            $finalResult->getNumber()
        ));

        $progressBar->finish();
        $this->symfonyStyle->newLine();
        $this->gameSay("Le {$finalResult->getNumber()} {$finalResult->getColor()} tombe !");
    }

    public function askText(string $message): string
    {
        $question = new Question($message);

        do {
            $result = $this->symfonyStyle->askQuestion($question);
        } while ((string) $result === '');

        return $result;
    }

    public function askInt(string $message): int
    {
        $question = new Question($message);

        do {
            $result = $this->symfonyStyle->askQuestion($question);
        } while (!is_numeric($result));

        return (int) $result;
    }
}
