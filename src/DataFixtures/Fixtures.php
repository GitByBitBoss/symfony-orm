namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\Lesson;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Benutzer anlegen
        $user1 = new User();
        $user1->setUsername('JohnDoe');
        $user1->setPassword('password123');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('JaneDoe');
        $user2->setPassword('password123');
        $manager->persist($user2);

        // Lektionen anlegen
        for ($i = 1; $i <= 5; $i++) {
            $lesson = new Lesson();
            $lesson->setTitle("Lesson $i");
            $lesson->setContent("Content for lesson $i.");
            $lesson->setUser($user1); // Zuweisung eines Lehrers (User)
            $manager->persist($lesson);

            // Fragen für die Lektionen anlegen
            for ($j = 1; $j <= 3; $j++) {
                $question = new Question();
                $question->setContent("Question $j for Lesson $i");
                $question->setLesson($lesson); // Verknüpfung der Frage mit der Lektion
                $manager->persist($question);
            }
        }

        // Daten in die DB speichern
        $manager->flush();
    }
}